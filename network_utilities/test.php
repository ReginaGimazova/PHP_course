<?php
/**
 * Created by PhpStorm.
 * User: gimaz
 * Date: 13.04.2018
 * Time: 17:51
 */

function esc_shell_args_for_address($address) {
    $url = parse_url($address);
    return escapeshellarg($url["host"]);

}

echo esc_shell_args_for_address("https://github.com/Arslandinho/PHPCourse/blob/master/network-utilities-v2/net-utils.php");