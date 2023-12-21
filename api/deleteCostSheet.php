<?php
include('../model/functionSQL.php');

header('Content-Type: application/json');

$idFicheFrais = $_POST['idFicheFrais'];
$request = new request();
$request->deleteAllCost($db, $idFicheFrais);
$request->deleteCostSheet($db, $idFicheFrais);



$json = array('status' => 200, 'message' => 'supprimé', 'Fiche Frais supprimé' => $idFicheFrais);

echo json_encode($json);