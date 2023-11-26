<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');

if(isset($_SESSION['name'])){
    $title = "Bonjour " .   $_SESSION['name'];
    $request = new request();
    $allMaxRefund = $request->getMaxPriceRefund($db);
    foreach ($allMaxRefund as $key => $value) {
        if($value['nomPrice'] == 'logement'){
            $maxRefund1night = $value['maxPrice'];
        }
        else if ($value['nomPrice'] == 'restauration'){
            $maxRefund1meal = $value['maxPrice'];
        }
    }
    include('../vue/pageVisiteurAddFrais.php'); 
}
else{
    header('Location: dashboard.php');
}