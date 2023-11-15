<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');

if(isset($_SESSION['name'])){
    //si on viens de pageVisiteur/Comptable et qu'on a cliqué sur le bouton 'Voir plus'
    if(isset($_POST['updateFrais'])){
        $idFrais = $_POST['idFrais'];
        $libelleFrais = $_POST['libelleFrais'];
        include('../vue/vuePreciseFrais.php');
    }
    else{
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}