<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 18/06/2019
 * Time: 09:55
 */

class Controller_New_Mvc extends Controller
{
    function __construct()
    {
        $this->model = new Model_New_Mvc();
        $this->view  = new View();
    }

    function action_index(){
        $data['title']  = "Создаем новые файлы MVC";
        $this->view->generate('new_mvc_view.php', 'layout.php', $data);
    }

    /**
     * создание файлов
     */
    function action_create_files(){
        if(isset($_POST['btn_create'])){
            $name = trim($_POST['name_files']);
            $path = trim($_POST['path_files']);
            //$this->model->save_file_model($name, $path);
            if(!$this->model->save_file_controller($name, $path)) {echo "Error1"; exit;}
            if(isset($_POST['model_chk'])){
                if(!$this->model->save_file_model($name, $path)) {echo "Error2"; exit;}
            }
            if(isset($_POST['view_chk'])){
                if(!$this->model->save_file_view($name, $path)) {echo "Error3"; exit;}
            }
            header("Location: /admin/new_mvc");
            exit;
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