<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 16/06/2019
 * Time: 22:54
 * Создание файла модели таблицы из базы данных
 */

class Model_Create_Model
{
    public $table_name;
    public $route_for_save;
    public $result;

    public function __construct($table_name, $route_for_save)
    {

        $this->table_name     = $table_name;
        $this->route_for_save = $route_for_save;
        $this->create_files();

    }

    private function create_files(){
        global $dbObject;
        $table_name = $this->table_name;

        if(!$table_name) {echo "no table name"; return false;}

        $sql = "SELECT * FROM $table_name LIMIT 0";
        //echo $sql;
        //exit();

        $rs = $dbObject->query($sql);

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
        $name_class = "Model_".ucfirst($table_name);
        $name_files = "model_".$table_name;


        //echo $name_files;
        //exit;
        /**
         * шапка для файла с описанием класса
         */
        $head  = "/**\n";
        $head .= " *Created by LigthMVC. \n";
        $head .= " * date: ". date("d.m.Y", time())."\n";
        $head .= " * user: tynyanyi@mail.ru \n";
        $head .= " * создано автоматически \n * через модуль администратора\n";
        (!empty($description)) ? $head .= " * Описание: $description\n":"";
        $head .= "*/\n";

        /**
         * Перебираем поля таблицы и формируем массивы с пееменными и значение масива
         */
        $text = "";
        foreach ($columns as $column){
            $str_var .= "  public $".$column."; \n";
            $str_arr .= "      '".$column."' => '".$column."', \n";
        }

        /**
         * собираем все строки в тексt
         */
        $text .="<?php\n";
        $text .= $head;
        $text .= "class $name_class extends Mysql {\n";
        $text .= "$str_var";
        $text .= "  public function fieldsTable() {\n";
        $text .= "    return array(\n";
        $text .= "$str_arr";
        $text .= "    );\n";
        $text .= "  }\n";
        $text .= "}";

        /**
         * за писываем все в файл с названием
         */
        // открываем файл, если файл не существует,
        //делается попытка создать его
        $fp = fopen($this->route_for_save."/".$name_files.".php", "w");

        // записываем в файл текст
        $this->result = fwrite($fp, $text);

        // закрываем
        fclose($fp);

    }

}