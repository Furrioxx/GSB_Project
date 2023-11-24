<?php
session_start();
include('../model/functionSQL.php');
include('../model/config.php');
include('tools.php');

if(isset($_SESSION['error_msg_profile'])){
    unset($_SESSION['error_msg_profile']);
}
if(isset($_SESSION['err-desacValidation'])){
    unset($_SESSION['err-desacValidation']);
}

if(isset($_SESSION['name'])){
    if(isset($_POST['submitNewPP'])){
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
    else if (isset($_POST['desacValidation'])){
        if(isset($_SESSION['err-desacValidation'])){
            unset($_SESSION['err-desacValidation']);
        }
        if(!empty($_POST['goodWord']) && !empty($_POST['writeWord'])){
            if($_POST['goodWord'] == $_POST['writeWord']){
                $request = new request();
                $request->desactiveUser($db, $_POST['idUser']);
                header('Location: dashboard.php');
            }
            else{
                var_dump($_POST['goodWord']);
                $_SESSION['err-desacValidation'] = "Les mots renseignés ne sont pas identiques";
                // header('Location: optionUser.php');
            }
        }
        else{

        }
    }
    else{
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}