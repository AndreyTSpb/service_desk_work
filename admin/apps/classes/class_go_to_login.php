<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 28/12/2019
 * Time: 21:37
 */

/**
 * Class Class_Go_To_Login
 * если не авторизован пользователь то его отправлять на страницу регистрации
 * но запоминать куда он хотел попасть
 */

class Class_Go_To_Login
{
    static function go($link){
        setcookie("ref_url", $link, time()+3600, '/');
        header("location: ".DOCUMENT_ROOT."/to_reg");
        exit;
    }
    static function go_to_link($link){
        setcookie("ref_url", "", time()-3600, '/');
        header("Location:".DOCUMENT_ROOT.$link);
        exit;
    }
}