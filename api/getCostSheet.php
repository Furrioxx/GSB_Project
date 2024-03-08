<?php
include('../model/functionSQL.php');
include('token.php');

header('Content-Type: application/json');

$idUser = $_POST['id'];
$isTraite = $_POST['isTraite'];
$token = $_POST['token'];
$mail = $_POST['mail'];

if(verifyToken($token, $mail, $db)){
    $fucntionSQL = new request();
    $result = $fucntionSQL->getCostSheet($db, $idUser);
    $json = array('status' => 200, 'function' => 'get cost sheet');
    foreach ($result as $key => $value) {
        if($isTraite == "T"){
            if($value['statue'] == $isTraite){
                $json['data'][$key] = $value;
            }
            else{
                continue;
            }
            
        }
        else if($isTraite == "NT"){
            if($value['statue'] == $isTraite){
                $json['data'][$key] = $value;
            }
            else{
                continue;
            }
        }
        else if($isTraite == "all"){
            $json['data'][$key] = $value;
        }
        
    }

    echo json_encode($json); 
}
else{
    $json = array('status' => 400, 'message' => 'mauvais password');
    echo json_encode($json); 
}

?>