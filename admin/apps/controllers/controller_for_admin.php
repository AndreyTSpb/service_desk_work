<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 26/12/2019
 * Time: 22:59
 */

class Controller_For_Admin extends Controller
{
    public $id_admin;
    public $hash_key_admin;
    public $name_admin;
    public $email_admin;

    function __construct()
    {
        $this->view = new View();

        //test cookie
        if(isset($_COOKIE['hash_key_admin']) AND !empty($_COOKIE['hash_key_admin'])){
            $this->hash_key_admin = substr($_COOKIE['hash_key_admin'],0,8);
        }
        if(isset($_COOKIE['id_admin']) AND !empty($_COOKIE['id_admin'])){
            $this->id_admin  = (int)$_COOKIE['id_admin'];
        }

        //test access

        if(!$this->access() AND $_SERVER['REQUEST_URI'] != "/signin"){
            //echo DOCUMENT_ROOT.DS."admin".DS."signin"; exit();
            //Ошибки не пишем
            //возврат на страниу логина
            header("Location: ".DOCUMENT_ROOT.DS."signin");
            exit();
        }

    }

    private function access(){
        $arr = Class_Test_Access::test($this->id_admin, $this->hash_key_admin);
        if(!$arr) return false;
        //
        $this->name_admin  = $arr['name'];
        $this->email_admin = $arr['email'];
        return true;
    }
}