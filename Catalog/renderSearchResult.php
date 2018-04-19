<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 19.04.2018
 * Time: 22:10
 */
function renderSearchResult($resultArrey){

    $resultForm = '';
    $resultForm .= '<div class="container">';
    $resultForm .='<link rel="stylesheet" type="text/css" href="../assets/style.css">';
    $resultForm .='<table class="table table-bordered">';
    $resultForm .='<tr><th>Product type</th><th>Name</th><th>Desc.</th><th>Price</th><th>View</th><th></th></tr>';

    foreach ($resultArrey as $key=>$value){

         $resultForm .="<tr><td>$value[type]</td>
                            <td>$value[name]</td>
                            <td>$value[description]</td>
                            <td>$value[price]</td>
                            <td>00000</td>
                            <td>To cart</td>
                            </tr>";


    }
    $resultForm .='</table>';
    $resultForm .='</div>';
    echo $resultForm;
}