<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 26/12/2019
 * Time: 21:46
 */

class Controller_Signin extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function action_index(){
        if(isset($_POST['signin'])){
            //print_r($_POST);
            $login = $_POST['email'];
            $pass = $_POST['pass'];
            if(!Class_Test_Login_Pass::test($login, $pass)){
                Class_Alert_Error::warning("Логин или  пароль не правельные");
                header("Location: ".DOCUMENT_ROOT.DS."signin");
                exit;
            }
            if(isset($_COOKIE['ref_url']) && !empty($_COOKIE['ref_url'])){
                Class_Go_To_Login::go_to_link($_COOKIE['ref_url']);
            }
            header("Location: ".DOCUMENT_ROOT.DS);
            exit();
        }
        $data['title']  = "Вход";
        $this->view->generate('', 'singin.php', $data);
    }
}