<?php
class Class_Get_Name_Klass_Truble{
    static function name($klassTrubleId){
        $obj = new Model_Klass_Truble(['where'=>'id = '.(int)$klassTrubleId]);
        if(!$obj->fetchOne()) return false;
        return $obj->name;
    }
}