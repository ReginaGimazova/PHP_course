<?php
    session_save_path(__DIR__ . "/session");
    session_name("session_name");
    session_set_cookie_params(100);
    session_start();

    include "input.html";
    if (!isset($_SESSION["session"])) {
        $_SESSION["session"] = $_POST["password"];
    }

    function set_options($url)
    {
        $curl = curl_init($url);

        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 1,
            CURLOPT_HTTPHEADER => array('Content-type: application/x-www-form-urlencoded'),
            CURLOPT_POSTFIELDS => http_build_query(array("password" => $_POST["password"])),
            CURLOPT_ENCODING => "UTF-8"
        ));

        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }

    $request_str = array(
        'http' => array(
            'method' => 'POST',
            'content' => http_build_query(array("password" => $_POST["password"]))
        )
    );

    $options_context = stream_context_create($request_str);
    echo(file_get_contents("http://localhost:63342/validatePassword/validate.php", false, $options_context));