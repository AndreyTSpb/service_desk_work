<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 25/12/2019
 * Time: 23:56
 */

class Controller_Main extends Controller_For_Admin
{
    function __construct()
    {
        parent::__construct();
    }

    function action_index(){
        $data['title']  = "Создаем новые файлы MVC";
        $this->view->generate('', 'dashboard.php', $data);
    }
}