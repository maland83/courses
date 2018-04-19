<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 18.04.2018
 * Time: 22:07
 */
include_once 'Users.php';
$User = new Users('','');
if ($User->ValidateConfirmRegistration()){
    $User->ConfirmRegistration();
};
