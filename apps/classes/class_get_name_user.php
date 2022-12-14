<?php
class Class_Get_Name_User{
    static function shortName($userId){
        $obj = new Model_Users(['where'=>'id = '.(int)$userId]);
        if(!$obj->fetchOne()) return "имя не указано";
        $name = explode(' ', $obj->name);
        return $name[0].' '.mb_substr($name[1], 0,1).'. '.mb_substr($name[2], 0,1).'.';
    }
}