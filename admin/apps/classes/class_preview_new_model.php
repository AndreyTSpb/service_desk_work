<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 17/06/2019
 * Time: 16:37
 */

class Class_Preview_New_Model
{
    static function text($table_name){
        global $dbObject;

        $rs = $dbObject->query('SELECT * FROM '.$table_name.' LIMIT 0');

        for ($i = 0; $i < $rs->columnCount(); $i++) {
            $col = $rs->getColumnMeta($i);
            $columns[] = $col['name'];
        }

        /**
         * переменые
         */
        $str_var = ""; //имена полей из таблицы для создания переменных
        $str_arr = ""; //массив с именами таблицы
        /**
         * Название файла и класса
         */
        $name_class = "Model_".$table_name;
        $name_files = "model_".$table_name;
        /**
         * шапка для файла с описанием класса
         */
        $head  = "/**";
        $head .= "<br>";
        $head .= "&#160;*Created by LigthMVC.";
        $head .= "<br>";
        $head .= "&#160;* date: ". date("d.m.Y", time());
        $head .= "<br>";
        $head .= "&#160;* user: tynyanyi@mail.ru ";
        $head .= "<br>";
        $head .= "&#160;* создано автоматически  "."<br>"."&#160;* через модуль администратора";
        $head .= "<br>";
        (!empty($description)) ? $head .= "&#160;* Описание: $description<br>":"";
        $head .= "*/<br>";

        /**
         * Перебираем поля таблицы и формируем массивы с пееменными и значение масива
         */
        $text = "";
        foreach ($columns as $column){
            $str_var .= "&#160;&#160;public $".$column."; <br>";
            $str_arr .= "&#160;&#160;&#160;&#160;&#160;&#160;'".$column."' => '".$column."', <br>";
        }

        /**
         * собираем все строки в тексt
         */
        $text .= $head;
        $text .= "class $name_class extends Mysql {<br>";
        $text .= "$str_var";
        $text .= "&#160;&#160;public function fieldsTable() {<br>";
        $text .= "&#160;&#160;&#160;&#160;return array(<br>";
        $text .= "$str_arr";
        $text .= "&#160;&#160;&#160;&#160;);<br>";
        $text .= "&#160;&#160;}<br>";
        $text .= "}";

        return $text;
    }

}