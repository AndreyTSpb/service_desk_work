<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 18/06/2019
 * Time: 14:20
 */

class Model_New_Mvc extends Model
{
    /**
     * сохраняем файл контролера
     */
    function save_file_controller($name,$path){
        /**
         * переменые
         */
        $route_for_save = "../".$path."controllers";
        /**
         * Название файла и класса
         */
        $class_name = "Controller_".ucfirst($name);
        $name_files = "controller_".$name;
        /**
         * шапка для файла с описанием класса
         */
        $head  = "<?php \n/**\n";
        $head .= " *Created by LigthMVC. \n";
        $head .= " * date: ". date("d.m.Y", time())."\n";
        $head .= " * user: tynyanyi@mail.ru \n";
        $head .= " * создано автоматически \n * через модуль администратора\n";
        (!empty($description)) ? $head .= " * Описание: $description\n":"";
        $head .= "*/\n";

        $body  = "class $class_name extends Controller\n";
        $body .= " {\n";
        $body .= "    function __construct()\n";
        $body .= "      {\n";
        $body .= "          \$this->model = new Model_$name();\n";
        $body .= "          \$this->view = new View();\n";
        $body .= "      }\n";
        $body .= "\n";
        $body .= "    function action_index()\n";
        $body .= "    {\n";
        $body .= "        \$data['title'] = 'Автоматически создано ';\n";
        $body .= "        \$data['profile'] = \$this->model->data_for_head();\n";
        $body .= "        \$this->view->generate('".$name."_view.php', 'layout.php', \$data);\n";
        $body .= "     }\n";
        $body .= " }";

        return $this->save_file($route_for_save,$name_files, $head.$body);
    }

    /**
     * Сохраняем фаил модели
     * @param $name
     * @param $path
     */
    function save_file_model($name,$path){
        /**
         * переменые
         */
        $route_for_save = "../".$path."models";
        /**
         * Название файла и класса
         */
        $model_name = "Model_".ucfirst($name);
        $name_files = "model_".$name;
        /**
         * шапка для файла с описанием класса
         */
        $head  = "<?php /**\n";
        $head .= " *Created by LigthMVC. \n";
        $head .= " * date: ". date("d.m.Y", time())."\n";
        $head .= " * user: tynyanyi@mail.ru \n";
        $head .= " * создано автоматически \n * через модуль администратора\n";
        (!empty($description)) ? $head .= " * Описание: $description\n":"";
        $head .= "*/\n";
        $body  = "class $model_name extends Model {\n";
        $body .= "  public function get_data() {\n";
        $body .= "    return array('data'=>'data');\n";
        $body .= "  }\n";
        $body .= "}";
        return $this->save_file($route_for_save,$name_files, $head.$body);
    }

    /**
     * Сохраняем фаил вьюхи
     * @param $name
     * @param $path
     */
    function save_file_view($name,$path){
        /**
         * переменые
         */
        $route_for_save = "../".$path."views";
        /**
         * Название файла и класса
         */
        $name_files = $name."_view";
        /**
         * шапка для файла с описанием класса
         */
        $head  = "<?php /**\n";
        $head .= " *Created by LigthMVC. \n";
        $head .= " * date: ". date("d.m.Y", time())."\n";
        $head .= " * user: tynyanyi@mail.ru \n";
        $head .= " * создано автоматически \n * через модуль администратора\n";
        (!empty($description)) ? $head .= " * Описание: $description\n":"";
        $head .= "*/\n?>\n";
        $body = "<h1>$name_files</h1>";

        return $this->save_file($route_for_save,$name_files, $head.$body);
    }
    /**
     * за писываем все в файл с названием
     */
    function save_file($route_for_save,$name_files, $text){

        // открываем файл, если файл не существует,
        //делается попытка создать его
        $fp = fopen($route_for_save."/".$name_files.".php", "w");

        // записываем в файл текст
        $result = fwrite($fp, $text);

        // закрываем
        fclose($fp);
        return $result;
    }

}