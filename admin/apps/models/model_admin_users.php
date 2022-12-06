<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 26/12/2019
 * Time: 23:34
 */

class Model_Admin_Users extends Mysql
{
    /**
     * Переменные
     */
    public $id;
    public $name;
    public $pass;
    public $email;
    public $hash_key;
    public $dt_visit;
    public $active;


    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'         => 'id',
            'name'       => 'name',
            'pass'       => 'pass',
            'email'      => 'email',
            'hash_key'   => 'hash_key',
            'dt_visit'   => 'dt_visit',
            'active'     => 'active'
        );
    }
}