<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');

if(isset($_POST['submitHF'])){
    $libelle = $_POST['libelle'];
    $montant = $_POST['montant'];
    $date = $_POST['date'];
    $request = new request;
    $request->insertFraisNotInclued($db);
    header('Location: dashboard.php');
}


if(isset($_POST['submitF'])){
    
}
?>