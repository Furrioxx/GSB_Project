<?php

header('Content-Type: application/json');


function generateToken($mail, $db){
    $request = new request();
    $TOKEN_LENGTH = 32;
    $token = bin2hex(openssl_random_pseudo_bytes($TOKEN_LENGTH));
    $request->addToken($db, $mail, $token);

    return $token;

}

function verifyToken($recievedToken, $recievedMail ,$db){
    $request = new request();
    $tokenSaved = $request->getToken($db, $recievedMail);
    $tokenCreatedAt = $request->getTokenCreatedAt($db, $recievedMail);

    $validityTime = new DateTime();
    $validityTime->modify('+1 hour');
    if(!empty($tokenSaved)){
        if($tokenSaved == $recievedToken && $tokenCreatedAt <= $validityTime){
            return true;
        }
        else{
            return false;
        }
    }else{
        return false;
    }
}

