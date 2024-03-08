<?php
include('../model/functionSQL.php');
include('token.php');

header('Content-Type: application/json');

$mail = $_POST['mail'];
$pass = $_POST['password'];

$fucntionSQL = new request();
$result = $fucntionSQL->getUser($db, $mail);

if(!empty($result)){
    foreach ($result as $key => $value) {
        if(strlen($pass) > 8){
            if(password_verify($pass, $value['password'])){
                $json = array('status' => 200, 'message' => 'connecté', 'token' => generateToken($mail, $db));
                foreach ($result as $key => $value) {
                    $json[$key] = $value;
                }
            }
            else{
                $json = array('status' => 400, 'message' => 'mauvais password');
            }
        }
    }
}
else{
    $json = array('status' => 400, 'message' => 'mauvais mail');
}

echo json_encode($json);