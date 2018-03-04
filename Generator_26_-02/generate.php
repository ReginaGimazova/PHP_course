<?php
/**
 * Created by PhpStorm.
 * User: gimaz
 * Date: 26.02.2018
 * Time: 16:33
 * @param $str
 * @return string
 */

require 'input.html';

function change_str($str){

    $change_Str = "";

    function generator_str($str){

        static $count = 0;

        for ($i = 0; $i < strlen($str); $i ++) {

            switch ($str[$i]) {
                case "h" :
                    $str[$i] = 4;
                    $count++;
                    yield $str[$i];
                    break;
                case "e" :
                    $str[$i] = 3;
                    $count++;
                    yield $str[$i];
                    break;
                case "o" :
                    $str[$i] = 0;
                    $count++;
                    yield $str[$i];
                    break;
                case "l":
                    $str[$i] = 1;
                    $count++;
                    yield $str[$i];
                    break;
                default :
                    yield $str[$i];
                    break;
            }
        }
        return $count;
    }

    $generator = generator_str($str);

    foreach ($generator as $value){
        $change_Str .= $value;
    }

    echo "count " .$generator->getReturn(). "<br>";
    return $change_Str;
}

$str = "";

if (isset($_POST['input'])){
    $str = $_POST['input'];
}

echo change_str($str);
