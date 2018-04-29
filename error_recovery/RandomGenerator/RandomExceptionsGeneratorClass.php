<?php
/**
 * Created by PhpStorm.
 * User: Regina
 * Date: 29.04.2018
 * Time: 15:10
 */

namespace RandomGenerator;

use Exceptions\FirstException;
use Exceptions\SecondException;
use Exceptions\ThirdException;
use Exceptions\FourthException;
use Exceptions\FifthException;


class RandomExceptionsGeneratorClass
{
    function method1(){
        $exc_array = $this->firstRandomException();
        $exception1 = $exc_array[0];
        $exception2 = $exc_array[1];
        if ($exception1){
            throw  $exception1;
        }
        throw $exception2;

    }

    function method2(){
        $exc_array = $this->firstRandomException();
        $exception1 = $exc_array[0];
        $exception2 = $exc_array[1];
        if ($exception1){
            throw  $exception1;
        }
        throw $exception2;
    }

    function method3(){
        $exc_array = $this->firstRandomException();
        $exception1 = $exc_array[0];
        $exception2 = $exc_array[1];
        if ($exception1){
            throw  $exception1;
        }
        throw $exception2;
    }

    function method4(){
        $exc_array = $this->firstRandomException();
        $exception1 = $exc_array[0];
        $exception2 = $exc_array[1];
        if ($exception1){
            throw  $exception1;
        }
        throw $exception2;
    }

    function firstRandomException(){
        $random = array(new FirstException('throw FirstException'), new SecondException('throw SecondException'),
            new ThirdException('throw ThirdException'), new FourthException('throw FourthException'), new FifthException('throw FifthException'));
        $random_keys = array_rand($random, 2);
        $exc_array = array($random[$random_keys[0]], $random[$random_keys[1]]);
        return $exc_array;
    }
}
