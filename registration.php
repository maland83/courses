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

    if (Users::Validate()==false){
        header('Location:/registration.php');
    }else{
      $user = new Users('','');
      $user->CompleteRegistration();
    }

}
