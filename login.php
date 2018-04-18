<?php
/**
 * Created by PhpStorm.
 * User: medias
 * Date: 17.04.2018
 * Time: 17:55
 */

include 'Users.php';

if (session_status()!=2){
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = new Users($_POST['uname'], $_POST['psw']);
    $user->Authorisation();

    if (!empty($user->currentUser)) {
        session_start();
        header('Location', '/');
    }else{
        Users::GetRegistrationForm();
    }
}