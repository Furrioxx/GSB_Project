<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');

if(isset($_POST['submitHF'])){
    $libelle = $_POST['libelle'];
    $montant = $_POST['montant'];
    $date = $_POST['date'];
    $request = new request;
    var_dump($request->createFicheFrais($db));
    // $request->insertFraisNotInclued($db);
    // header('Location: dashboard.php');
}

if(isset($_POST['submitF'])){
    $imatTransport = $_POST['imatTransport'];
    $kmTransport = $_POST['kmTransport'];
    $NameLogement = $_POST['NameLogement'];
    $priceLogement = $_POST['priceLogement'];
    $restaurantName = $_POST['restaurantName'];
    $restaurantPrice = $_POST['restaurantPrice'];
    $dateTransport = $_POST['dateTransport'];
    $dateLogement = $_POST['dateLogement'];
    $restaurantDate = $_POST['restaurantDate'];

    if(!empty($imatTransport) || !empty($kmTransport) || !empty($dateTransport)){
        
    }
    else{
        echo 'cocucocu';
    }
}

if(isset($_POST['submitF'])){

}
?>