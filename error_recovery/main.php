<?php
/**
 * Created by PhpStorm.
 * User: Regina
 * Date: 29.04.2018
 * Time: 14:58
 */

    spl_autoload_register(function ($class_name) {
        include "$class_name.php";
    });

    $exceptionGenerator = new RandomGenerator\RandomExceptionsGeneratorClass();

    try{
        $exceptionGenerator->method1();
    }
    catch (\Exceptions\FifthException | \Exceptions\FourthException |  \Exceptions\ThirdException
    | \Exceptions\SecondException | \Exceptions\FirstException  $exception) {
        print $exception->getMessage() . "\n";
    }

    try{
        $exceptionGenerator->method2();
    }
    catch (\Exceptions\FifthException | \Exceptions\FourthException |  \Exceptions\ThirdException
    | \Exceptions\SecondException | \Exceptions\FirstException  $exception) {
        print $exception->getMessage() . "\n";
    }


    try {
        $exceptionGenerator->method3();
    }
    catch (\Exceptions\FifthException | \Exceptions\FourthException |  \Exceptions\ThirdException
    | \Exceptions\SecondException | \Exceptions\FirstException  $exception) {
        print $exception->getMessage() . "\n";
    }


    try {
        $exceptionGenerator->method4();
    }
    catch (\Exceptions\FifthException | \Exceptions\FourthException |  \Exceptions\ThirdException
    | \Exceptions\SecondException | \Exceptions\FirstException  $exception) {
        print $exception->getMessage() . "\n";
    }

