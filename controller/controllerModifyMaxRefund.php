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
                $maxPrice1night = $value['maxPrice'];
            }
            else if ($value['nomPrice'] == 'restauration'){
                $maxPrice1Meal =  $value['maxPrice'];
            }
        }
    include('../vue/pageModifyMaxRefund.php');
}
else{
    header('Location: dashboard.php');
}