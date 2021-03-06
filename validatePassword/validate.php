<?php
/**Длина пароля не менее 10 символов
 * пароль содержит хотя бы по 2 символа из каждой категории: латинские прописные буквы; латинские строчные буквы;
цифры; символы %$#_*
 * Пароль не содержит более чем 3 символов любой категории подряд */


require "input.html";

function val_psw($password){
    $errors = array(
        "длина пароля должна быть не менее 10 символов" => preg_match("/^\S{0,9}$/", $password),
        "пароль содержит менее 2 заглавных букв" => !preg_match("/(\S*[A-Z]+\S*){2,}/", $password),
        "пароль содержит менее 2 строчных букв" => !preg_match("/(\S*[a-z]+\S*){2,}/", $password),
        "пароль содержит менее 2 цифр" => !preg_match("/(\S*\d+\S*){2,}/", $password),
        "пароль содержит менее 2 спецсимволов" => !preg_match("/(\S*[%$#_\*]+\S*){2,}/", $password),
        "пароль содержит более 3 заглавных букв подряд" => preg_match("/[A-Z]{4,}/", $password),
        "пароль содержит более 3 строчных букв подряд" => preg_match("/[a-z]{4,}/", $password),
        "пароль содержит более 3 цифр подряд" => preg_match("/\d{4,}/", $password),
        "пароль содержит более 3 спецсимволов подряд" => preg_match("/[%$#_\*]{4,}/", $password),
    );

    foreach ($errors as $key => $value) {
        if ($value)
            echo $key. "<br>";
    }
}

$password = "";
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    val_psw($password);
}
