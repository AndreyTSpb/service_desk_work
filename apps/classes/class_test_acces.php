<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 26/11/2019
 * Time: 16:58
 */

/**
 * Class Class_Test_Acces - проверка доступа к странице
 */

class Class_Test_Acces
{
    static function test($email, $pass){
        $pass  = md5(trim($pass));

        $sql = ["where"=>"email = '".$email. "' AND pass = '".$pass."' "];

        $obj = new Model_Users($sql);
        if(!$obj->fetchOne()) return false;

        $hash_key = Class_Generator_Heskey::generator();
        if(empty($hash_key)) return false;

        $obj->hash = md5($hash_key);
        if(!$obj->update()) return false;

        setcookie("hash_key", $hash_key, time()+36000, "/");
        setcookie("id_user", $obj->id, time()+36000, "/");
        return $obj->roles_id;
    }
}