<?php
include('../model/functionSQL.php');

header('Content-Type: application/json');

$idUser = $_POST['id'];

$fucntionSQL = new request();
$result = $fucntionSQL->getUserWhithId($db, $idUser);
$json = array('status' => 200, 'function' => 'getUserWithId');
foreach ($result as $key => $value) {
    $json['data'] = $value; 
}

echo json_encode($json);
?>