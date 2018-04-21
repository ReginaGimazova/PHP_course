<?php

    function getRuleSymbols($string, $length){
        return substr($string, 0, $length);
    }

    function parseFile($iniFile){
        $iniArray = parse_ini_file($iniFile, true);
        return $iniArray;
    }

    function getOptions($iniArray){
        $options = [];
        foreach ($iniArray as $key => $value){
            foreach ($value as $param_key => $param){
                if ($param_key == 'filename'){
                    $options[$param_key] = $value[$param_key];
                }
                else{
                    $rule_key = reset($value);
                    $options[$rule_key] = end($value);
                }
            }
        }
        return $options;
    }

    function getTypesOfConvert($value, $string, $key)
    {
        $string = substr($string, strlen($key));

        switch ($value) {
            case "+":
                $symbolsOfStr = str_split($string);

                for ($i = 0; $i < count($symbolsOfStr); $i++) {
                    if (preg_match("/\d/", $symbolsOfStr[$i])) {
                        if ($symbolsOfStr[$i] == "9") {
                            $symbolsOfStr[$i] = "0";
                        } else {
                            $symbolsOfStr[$i]++;
                        }
                    }
                }
                return implode($symbolsOfStr);

            case "-":
                $symbolsOfStr = str_split($string);

                for ($i = 0; $i < count($symbolsOfStr); $i++) {
                    if (preg_match("/\d/", $symbolsOfStr[$i])) {
                        if ($symbolsOfStr[$i] == "0") {
                            $symbolsOfStr[$i] = "9";
                        } else {
                            $symbolsOfStr[$i]--;
                        }
                    }
                }
                return implode($symbolsOfStr);

            case "true":
                return strtoupper($string);

            case "false":
                return strtolower($string);

            default :
                return str_replace($value, "", $string);
        }
    }

    function convertString($string, $options_array){

        foreach ($options_array as $key => $value){
            if (substr($string, 0, strlen($key)) == $key){
                return getTypesOfConvert($value, $string, $key);
            }
        }
        return $string;
    }

    function convertFile(){
        $options_array = getOptions(parseFile("index.ini"));
        $strings = file($options_array["filename"]);
        foreach ($strings as $string) {
           echo convertString($string, $options_array);
        }
    }
    convertFile();

