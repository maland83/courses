<?php

include 'login.php';
include_once 'Users.php';


if (empty($_COOKIE['PHPSESSID'])) {
    Users::GetLoginForm();
    exit;
}else{
    echo '';
}