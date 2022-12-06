<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 28/12/2019
 * Time: 22:11
 */

class Class_Test_Access
{
    static function test($id, $hash){
        $hash = strip_tags(trim($hash));
        $id   = (int)$id;

        $obj = new Model_Admin_Users(['where' => "id = $id AND hash_key = '$hash'"]);
        if(!$obj->fetchOne()) return false;
        $name = $obj->name;
        $email = $obj->email;
        return compact("name", "email");
    }
}