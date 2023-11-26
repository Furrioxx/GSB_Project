<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');

if(isset($_SESSION['name'])){
    //si on viens de pageVisiteur/Comptable et qu'on a cliqué sur le bouton 'Voir plus'
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
    if(isset($_POST['seeFicheFrais'])){
        $idFicheFrais = $_POST['idFicheFrais'];
        include('../vue/vueDetailFicheFrais.php');
    }
    else if($_SESSION['idFicheFrais']){
        $idFicheFrais = $_SESSION['idFicheFrais'];
        unset($_SESSION['idFicheFrais']);
        include('../vue/vueDetailFicheFrais.php');
        
    }
    else{
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}

?>