<?php

    function getRuleSymbols($string){
        return substr($string, 0, 3);
    }

    function parseFile($iniFile){
        $iniArray = parse_ini_file($iniFile);
        return $iniArray;
    }

    function getFileName($iniArray){
        $filename = $iniArray["filename"];
        return $filename;
    }

    function getOptions($iniArray){
        $optionsArray = [];
        foreach ($iniArray as $key => $value){
            if ($key !== "filename" & $key !== "symbol"){
                $optionsArray[$key] = $value;
            }
        }
        return $optionsArray;
    }

    function getTypesOfConvert($value, $string)
    {
        $string = substr($string, 3);

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

    function convertString($string){
        $rule = getRuleSymbols($string);
        $optionsArray = getOptions(parseFile("index.ini"));
        switch ($rule){
            case "1st":
                return getTypesOfConvert($optionsArray["upper"], $string);
            case "2nd":
                return getTypesOfConvert($optionsArray["direction"], $string);
            case "3rd":
                return getTypesOfConvert($optionsArray["delete"], $string);
            default:
                return $string;
        }
    }

    function convertFile(){
        $file = getFileName(parseFile("index.ini"));
        $strings = file($file);
        foreach ($strings as $string) {
           echo convertString($string);
        }
    }
    convertFile();