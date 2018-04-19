<?php
/**
 * Created by PhpStorm.
 * User: medias
 * Date: 17.04.2018
 * Time: 17:40
 */

include_once 'Users.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    Users::GetRegistrationForm();
    exit();
} else {

    $user = new Users('','');
    if ($user->Validate()==false){
        header('Location:/users/registration.php');
    }else{
      $user->CompleteRegistration();
        header('Location:/');
    }

}
