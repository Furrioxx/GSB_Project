<?php

include('../model/functionSQL.php');

header('Content-Type: application/json');

include '../controller/tools.php';

$idUser = $_POST['idUser'];

if(isset($_POST['newLibelle']) || isset($_POST['newMontant']) || isset($_POST['newTiming']) || isset($_FILES['newJustif'])){
    $idFrais = $_POST['idFrais'];
    $request = new request();
    $result = $request->getPreciseCost($db, $idFrais);

    $actualLibelle = $result[0]['libelle'];
    $actualTiming = $result[0]['timing'];
    $actualMontant = $result[0]['montant'];
    $actualLinkJustif = $result[0]['linkJustif'];
    $idFicheFrais = $result[0]['idFicheFrais'];

    //pour HF
    if(isset($_POST['newLibelle']) && isset($_POST['newMontant']) && isset($_FILES['newJustif'])){
        if(!empty($_POST['newMontant']) && !empty($_POST['newLibelle'] && $_FILES['newJustif']["error"] == 0)){
            $tools = new tools();
            $request->updateFrais($db, $_POST['newLibelle'], $_POST['newMontant'], $actualTiming, $tools->downloadImage('../uploads/'.$idUser.'/', 'newJustif'), $idFrais);
        }
        else if(!empty($_POST['newMontant']) && !empty($_POST['newLibelle'])){
            $request->updateFrais($db, $_POST['newLibelle'], $_POST['newMontant'], $actualTiming, $actualLinkJustif, $idFrais);
        }
    }
    //pour train
    else if(isset($_POST['newMontant']) && isset($_FILES['newJustif'])){
        if(!empty($_POST['newMontant']) && $_FILES['newJustif']["error"] == 0){
            $tools = new tools();
            $request->updateFrais($db, $actualLibelle, $_POST['newMontant'], $actualTiming, $tools->downloadImage('../uploads/'.$idUser.'/', 'newJustif'), $idFrais);
        }
        else if(!empty($_POST['newMontant'])){
            $request->updateFrais($db, $actualLibelle, $_POST['newMontant'], $actualTiming, $actualLinkJustif, $idFrais);
        }
    }
    //pour restauration / dodo
    else if(isset($_POST['newMontant']) && isset($_POST['newTiming'])){
        if(!empty($_POST['newMontant']) && !empty($_POST['newTiming'])){
            $request->updateFrais($db, $actualLibelle, $_POST['newMontant'], $_POST['newTiming'], $actualLinkJustif, $idFrais);
        }
    }
    //pour la voiture
    else if(isset($_POST['newTiming'])){
        if(!empty($_POST['newTiming'])){
            $tools = new tools();
            $cost = $tools->calculPriceCar($db, $_POST['newTiming'], $idUser);
            $request->updateFrais($db, $actualLibelle, $cost, $_POST['newTiming'], $actualLinkJustif, $idFrais);
        }
    }
    $request->updatePriceCostSheet($db, $idFicheFrais);
    $json = array('status' => 200, 'statut' => 'Succès');
    foreach ($request->getPreciseCost($db,$idFrais) as $key => $value) {
        $json['frais modifié'] = $value;
    }
}
else{
    $json = array('status' => 400, 'statut' => 'Erreur');
}

echo json_encode($json);