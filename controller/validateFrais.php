<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');
include('../controller/tools.php');

if(isset($_SESSION['err-validate-frais'])){
    unset($_SESSION['err-validate-frais']);
}

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
        //si le montant des remboursement dépasse le montant indiqué par le visiteur
        if($tools->verifRefundMontant($db, $refundMontantOther, $refundMontantTransport, $idFicheFrais)){   
            $tools->validateFrais($db, $idFicheFrais, $refundMontantTransport, $refundMontantOther); 
            $_SESSION['popUpValidateFrais'] = true;
            header('Location: dashboard.php');
        }
        else{
            $_SESSION['err-validate-frais'] =  "les montant renseigné par le comptable est supérieur au montant renseigné par le visiteur";
            header('Location: detailFicheFrais.php');
        }
        
    }
    else{
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}