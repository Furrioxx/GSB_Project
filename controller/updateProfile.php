<?php
session_start();
include('../model/functionSQL.php');
include('../model/config.php');
include('tools.php');

if(isset($_SESSION['error_msg_profile'])){
    unset($_SESSION['error_msg_profile']);
}

if(isset($_SESSION['name'])){
    if(isset($_POST['submit'])){
        if(isset($_FILES['newPP']) && $_FILES['newPP']['error'] == 0){
            $request = new request();
            $tools = new tools();
            $request->updatePP($db, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newPP'), $_SESSION['idUser']);
            header('Location: profile.php');
        }
        else{
            $_SESSION['error_msg_profile'] = "Vous n'avez pas remplie le champs";
            header('Location: profile.php');
        }
    }
    else{
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}