<?php
class Controller_logout extends Controller{
    public function action_index()
    {
        setcookie("id_user", '', time() - 2592000,'/');
        setcookie("hash_key", '', time() - 2592000,'/');
        header('Location: '.DOCUMENT_ROOT.'/login');
        exit();
    }
}