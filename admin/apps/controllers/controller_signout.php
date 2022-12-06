<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 29/12/2019
 * Time: 09:39
 */

class Controller_Signout extends Controller_For_Admin
{
    function action_index()
    {
        setcookie("id_admin", "", time()-3200, "/admin");
        setcookie("hash_key_admin", "", time()-3200, "/admin");
        header("Location:".DOCUMENT_ROOT.DS);
        exit;
    }
}