<?php

include '../courses/users/login.php';
include_once '../courses/users/Users.php';
include_once '../courses/Catalog/Product.php';



if (empty($_COOKIE['PHPSESSID'])) {
    Users::GetLoginForm();
    exit;
}else{
    include_once 'Catalog/searchForm.html';
    echo '';
}