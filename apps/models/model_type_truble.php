<?php
class Model_Type_Truble extends Mysql
{
    public $id;
    public $name;
    public $klass_truble_id;
    public $note;
    public $del;

    public function fieldsTable() {
        return array(
            'id' => 'id',
            'name' => 'name',
            'klass_truble_id' => 'klass_truble_id',
            'note'  => 'note',
            'del' => 'del'
        );
    }
}