<?php
session_start();
include('../model/functionSQL.php');
include('../model/config.php');
include('tools.php');

if(isset($_SESSION['name'])){
    if(isset($_POST['submitModifMaxRefund'])){
        if(isset($_SESSION['err-modifMaxRefund'])){
            unset($_SESSION['err-modifMaxRefund']);
        }
        $request = new request();
        $result = $request->getMaxPriceRefund($db); 
        foreach ($result as $key => $value) {
            if($value['nomPrice'] == 'logement'){
                if($value['maxPrice'] != $_POST['maxPrice1night']){
                    if(!empty($_POST['maxPrice1night'])){
                        $request->updateMaxRefund($db, 'logement', $_POST['maxPrice1night']);
                    }
                    else{
                        $_SESSION['err-modifMaxRefund'] = "Un des champs est vide";
                        header('Location: controllerModifyMaxRefund.php');
                    }
                }
            }
            
            else if($value['nomPrice'] == 'restauration'){
                if($value['maxPrice'] != $_POST['maxPrice1Meal']){
                    if(!empty($_POST['maxPrice1Meal'])){
                        $request->updateMaxRefund($db, 'restauration', $_POST['maxPrice1Meal']);
                    }
                    else{
                        $_SESSION['err-modifMaxRefund'] = "Un des champs est vide";
                        header('Location: controllerModifyMaxRefund.php');
                    }
                }
            }
        }
        header('Location: dashboard.php');
    }
    else{
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}