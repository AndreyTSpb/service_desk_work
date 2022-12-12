<?php 
class Class_Get_Name_Type_Truble{
    static function name($id)
    {
        $obj = new Model_Type_Truble(['where'=>'id = '.(int)$id]);
        $obj->fetchOne();
        return $obj->name;        # code...
    }
}