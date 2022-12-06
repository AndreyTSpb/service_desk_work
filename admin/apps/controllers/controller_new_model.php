<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 17/06/2019
 * Time: 12:48
 */

class Controller_New_Model extends Controller
{
    function __construct()
    {
        $this->model = new Model_New_Model();
        $this->view = new View();
    }

    function action_index(){
        $data['title']  = "Создаем новый файл модели для таблицы";
        $data['tables'] = $this->model->get_tables_name();
        $this->view->generate('new_model_view.php', 'index.php', $data);
    }

    /**
     * Создание модели
     */
    function action_create_model(){
        if(isset($_POST['submit_model'])) {
            $table_name = $_POST['name_model'];
            $route_for_save = $_POST['model_path'];
            $obj = new Model_Create_Model($table_name, $route_for_save);
            if (!$obj->result) {
                header("Location: ".DOCUMENT_ROOT."/new_model");
                exit();
            }
            header("Location: ".DOCUMENT_ROOT."/new_model");
            exit();
        }
    }

    /**
     * Превью тела создаваемой модели
     */
    function action_ajax_preview(){
        if(isset($_POST['preview'])){
            echo Class_Preview_New_Model::text($_POST['table_name']);
            exit();
        }
    }

    /**
     * проверка существует ли файл
     */
    function action_ajax_file_exist(){
        $url = $_POST['url'];
        $file = $_POST['name'];
        if (file_exists($url."/".$file)) {
            echo 1;
            exit();
        } else {
            echo 0;
            exit();
        }
    }
}