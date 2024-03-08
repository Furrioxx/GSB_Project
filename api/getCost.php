<?php
include('../model/functionSQL.php');
include('token.php');

header('Content-Type: application/json');

$idFicheFrais = $_POST['idFicheFrais'];
$token = $_POST['token'];
$mail = $_POST['mail'];

if(verifyToken($token, $mail, $db)){
        $fucntionSQL = new request();
        $result = $fucntionSQL->getAllCost($db, $idFicheFrais);
        $json = array('status' => 200, 'statut' => 'Succès');
        foreach ($result as $key => $value) {
                $json['data'][$key] = $value;
        }

        echo json_encode($json); 
}

?>