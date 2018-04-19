<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 19.04.2018
 * Time: 08:27
 */
if (session_status()!=2){
    session_start();
}
if ($_SERVER['REQUEST_METHOD']=='POST'){
    if (!empty($_POST['LogOut'])){

        unset($_SESSION['CurrentUserID']);
        header('Location:/');
    }
}
