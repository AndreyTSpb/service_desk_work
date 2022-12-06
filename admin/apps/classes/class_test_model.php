<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 17/06/2019
 * Time: 13:35
 */

/**
 * Class class_test_model - проверка на существование модели
 */
class Class_Test_Model
{
    static function test_name($name){
        $filename = $_SERVER['DOCUMENT_ROOT'].DS."apps".DS."models".DS."model_".$name.".php";

        if (file_exists($filename)) {
            return true;
        } else {
            return false;
        }
        return false;
    }
}