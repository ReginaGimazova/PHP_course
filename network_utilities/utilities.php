<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('max_execution_time', 250);

require "utilities.html";

function shell($address) {
    return escapeshellarg($address);

}

function check_valid_ip($ip){
    return filter_var($ip, FILTER_VALIDATE_IP);
}

function get_ip($address){
    $ip = gethostbyname($address);
    return $ip;
}

function get_percent_of_ping($address){
    putenv('LANG=en_US.UTF-8');
    exec("ping -n 3 $address", $output, $status);
    $output = iconv("CP866", "UTF-8", implode($output));
    preg_match("/\d+%/", $output, $match);
    preg_match("/\d+/", $match[0], $match1);
    return (100 - intval($match1[0])). "%";
}

function get_ip_address_after_tracert($address){
    $result_of_tracert = shell_exec("tracert " . $address);
    preg_match_all('/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/', $result_of_tracert, $matches, PREG_PATTERN_ORDER);
    return "<b>" .implode(" ", $matches[0]). "</b>";
}

function result_to_output($address, $utility){
    if (check_valid_ip(get_ip($address))){
        echo "<p><b>" .get_ip($address). "</b></p>";
        if ($utility == "ping"){
            echo "успешных запросов: " .get_percent_of_ping(get_ip($address));
        }
        if ($utility == "tracert"){
            echo get_ip_address_after_tracert($address);
        }
    }
    else {
        echo "Неправильный адрес. Повторите попытку";
    }
}
if (isset($_POST['address']) && isset($_POST['utility'])) {
    $address = $_POST['address'];
    $utility = trim($_POST['utility']);
    result_to_output($address, $utility);
}
