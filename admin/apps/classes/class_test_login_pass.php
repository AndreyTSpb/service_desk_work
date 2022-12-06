<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 28/12/2019
 * Time: 21:04
 */

class Class_Test_Login_Pass
{
    static function test($login, $pass){
        $login = strip_tags(trim($login));
        $pass  = md5(trim($pass));

        $obj = new Model_Admin_Users(["where"=>"email = '$login' AND pass = '$pass'"]);
        if(!$obj->fetchOne()) return false;

        $hash = $obj->hash_key;
        if(!$hash) {
            $hash = $obj->hash_key = Class_Generate_Hash_Key::gen();
        }

        $obj->dt_visit = time();

        if(!$obj->update()) return false;

        setcookie("id_admin", $obj->id, time() + 3600*24, "/admin");
        setcookie("hash_key_admin", $hash, time() + 3600*24, "/admin");
        return true;
    }

}