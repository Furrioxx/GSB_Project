<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');

if(isset($_SESSION['name'])){
    if(isset($_POST['desacBtn'])){
        $_SESSION['idUserModif'] = $_POST['idUser'];
        include('../vue/pageVerifDesa.php');
    }
    else if(isset($_SESSION['err-desacValidation'])){
        include('../vue/pageVerifDesa.php');
    }
    else if(isset($_POST['modifyBtn'])){
        $_SESSION['idUserModif'] = $_POST['idUser'];
        include('../vue/pageModifyProfile.php');
    }
    else if(isset($_SESSION['err-modifValidation'])){
        include('../vue/pageModifyProfile.php');
    }
    else if (isset($_POST['submitNewPass'])){
        $_SESSION['newPass'] = true;
        include('../vue/pageChangePassword.php');
    }
    else if(isset($_SESSION['error_msg_password'])){
        include('../vue/pageChangePassword.php'); 
    }
    else{
        header('Location: dashboard.php');
    }

}
else{
    header('Location: dashboard.php');
}