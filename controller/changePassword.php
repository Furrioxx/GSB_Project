<?php
session_start();
include('../model/functionSQL.php');
include('../model/config.php');

if(isset($_SESSION['error_msg_password'])){
    unset($_SESSION['error_msg_password']);
}

if(isset($_SESSION['name'])){
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    if(!empty($password) && !empty($repassword)){
        if($password == $repassword){
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $id = $_SESSION['idUser'];
            $request = new request();
            $request->updatePassword($db, $hashPassword, $id);
            if(isset($_SESSION['isFirstConnexion'])){
                unset($_SESSION['isFirstConnexion']);  
            }
            if(isset($_SESSION['newPass'])){
                unset($_SESSION['newPass']);
                $_SESSION['popupModifPass'] = true;
            }
            header('Location: dashboard.php');
        }
        else{
            $_SESSION['error_msg_password'] = "Les mots de passes ne sont pas identiques";
            if(isset($_SESSION['newPass'])){
                header('Location: optionUser.php');
            }
            else{
                header('Location: dashboard.php');  
            }
        }
    }
    else{
        $_SESSION['error_msg_password'] = "Tous les champs n'ont pas été remplies";
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}