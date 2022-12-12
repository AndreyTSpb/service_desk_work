<?php
/**
 * Created by PhpStorm.
 * User: atynyanygmail.com
 * Date: 02/05/2019
 * Time: 14:11
 */

class Controller {

    public $model;
    public $view;
    public $hash_key;
    public $id_user;
    public $role;

    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();

        if(isset($_COOKIE['id_user']) AND !empty($_COOKIE['id_user'])) $this->model->id_user = $this->id_user = (int)$_COOKIE['id_user'];
        /**
         * Проверка доступа
         */
        if(isset($_COOKIE['hash_key']) AND !empty($_COOKIE['hash_key'])){
            $this->hash_key = substr($_COOKIE['hash_key'],0,8);
        }

        
        if(!empty($this->hash_key) AND !empty($this->id_user)){
            //print_r($this->test($this->hash_key, $this->id_user)); exit;
            //exit;
            if(!$this->test($this->hash_key, $this->id_user) AND ($_SERVER['REQUEST_URI'] !== '/login')) {
                header('Location: '.DOCUMENT_ROOT.'/login');
                exit;
            }
        }
        if((empty($this->hash_key) OR empty($this->id_user)) AND ($_SERVER['REQUEST_URI'] !== '/login')){
            header('Location: '.DOCUMENT_ROOT.'/login');
            exit;
        }
    }

    function test($hash_key, $id_user){
        $sql = array('where'=>"id = ".(int)$id_user." AND hash = '".md5(substr($hash_key,0,8))."'");
        //print_r($sql);
        $obj = new Model_Users($sql);
        if(!$obj->fetchOne()) return false;
        $id_user = $obj->id;
        $this->role = $obj->roles_id;
        return $id_user;
    }

    // действие (action), вызываемое по умолчанию
    public function action_index()
    {
        // todo
    }
}
