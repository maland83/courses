<?php


include_once 'Users.php';



if (empty($_COOKIE['PHPSESSID'])){
    Users::GetLoginForm();
//   exit;
}

/*

include 'Database.php';

$Database = new Database('','');*/

