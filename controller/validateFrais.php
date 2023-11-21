<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');
include('../controller/tools.php');

if(isset($_SESSION['name'])){
    if(isset($_POST['submitValidateFrais'])){
        $idFicheFrais = $_POST['idFicheFrais'];
        if(isset($_POST['refundMontantTransport'])){
            $refundMontantTransport = $_POST['refundMontantTransport'];
        }
        else{
            $refundMontantTransport = null;
        }
        if(isset($_POST['refundMontantOther'])){
            $refundMontantOther = $_POST['refundMontantOther'];
        }
        else{
            $refundMontantOther = null;
        }
        $_SESSION['idFicheFrais'] = $idFicheFrais;
        $tools = new tools();
        if($tools->verifRefundMontant($db, $refundMontantOther, $refundMontantTransport, $idFicheFrais)){   
            $tools->validateFrais($db, $idFicheFrais, $refundMontantTransport, $refundMontantOther); 
            header('Location: dashboard.php');
        }
        else{
            echo 'test';
        }
        
    }
    else{
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}