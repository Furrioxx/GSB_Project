<?php

include('../model/functionSQL.php');

header('Content-Type: application/json');

include '../controller/tools.php';

$idUser = $_POST['idUser'];

$beginDate = $_POST['beginDate'];
$endDate = $_POST['endDate'];

$kmTransport = $_POST['kmTransport'];
if(isset($_POST['transportMontant'])){
    $transportMontant = $_POST['transportMontant'];
}


$TimeLogement = $_POST['TimeLogement'];
$priceLogement = $_POST['priceLogement'];

$restaurantTime = $_POST['restaurantTime'];
$restaurantPrice = $_POST['restaurantPrice'];

$libelleOther = $_POST['libelleOther'];
$montantOther = $_POST['montantOther'];

$request = new request;

if(!empty($beginDate) || !empty($endDate)){
    //vérification de la validité des dates 
    if($beginDate <= $endDate){
    //si au moins 1 frais est remplie :
        if(!empty($kmTransport) || !empty($transportMontant) || !empty($TimeLogement) || !empty($priceLogement) || !empty($restaurantTime) || !empty($restaurantPrice) || !empty($libelleOther) || !empty($montantOther)){
            //creer une fiche frais et return son id
            $idFicheFrais = $request->createFicheFrais($db, $beginDate, $endDate, $idUser);
            if($_POST['transport'] == "car"){   
                if(!empty($kmTransport)){
                    $tools = new tools();
                    $request->sendFrais($db,null,'transport (voiture)', $tools->calculPriceCar($db, $kmTransport, $idUser), $kmTransport , $endDate, $idFicheFrais, 'F', null);
                }
            }
            //si le transport est le train
            else{
                
                if(!empty($transportMontant) && isset($_FILES['transportFile'])){
                    $fileDownload = new tools();
                    $request->sendFrais($db, null, 'transport (train)', $transportMontant, null, $endDate, $idFicheFrais, 'HF', $fileDownload->downloadImage('../uploads/'.$idUser.'/', 'transportFile'));
                }
            }
            //si les champs hebergement on été remplies
            if(!empty($TimeLogement) && !empty($priceLogement)){
                if($TimeLogement  != 0){
                    $request->sendFrais($db,null,'logement',$priceLogement, $TimeLogement , $endDate, $idFicheFrais, 'F', null);
                }
            }
            //si les champs alimentations on été remplies
            if(!empty($restaurantTime) && !empty($restaurantPrice)){
                if($restaurantTime != 0){
                    $request->sendFrais($db,null,'restauration',$restaurantPrice, $restaurantTime , $endDate, $idFicheFrais, 'F', null);
                }
            }
            //si le champs autre a été remplies
            if(!empty($libelleOther) &&  !empty($montantOther) && isset($_FILES['fileOther'])){
                $fileDownload = new tools();
                $request->sendFrais($db, null, $libelleOther, $montantOther, null, $endDate, $idFicheFrais, 'HF', $fileDownload->downloadImage('../uploads/'.$idUser.'/', 'fileOther'));   
            }
            $request->updatePriceCostSheet($db, $idFicheFrais);
            $json = array('status' => 200, 'statut' => 'Succès', 'id fiche de frais' => $idFicheFrais);
        }
    }
    else{
        $json = array('status' => 400, 'statut' => 'Erreur', 'Error Message' => 'les dates remplies ne sont pas valides ');
    }
}
else{
    $json = array('status' => 400, 'statut' => 'Erreur', 'Error Message' => 'le champs des dates n\'a pas été remplie');
}

echo json_encode($json);