<?php
include('../model/config.php');
include('../model/functionSQL.php');
    $libelle = $_POST['libelle'];
    $montant = $_POST['montant'];
    $date = $_POST['date'];

    if(isset($_POST['submit'])){
        $request = new request;
        $request->insertFraisNotInclued($db);
        header('Location: dashboard.php');
    }
?>