<?php
class Model_Type_Truble extends Mysql
{
    public $id;
    public $name;
    public $del;

    public function fieldsTable() {
        return array(
            'id' => 'id',
            'name' => 'name',
            'del' => 'del'
        );
    }
}