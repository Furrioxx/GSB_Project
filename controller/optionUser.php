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
    else{
        include('../vue/pageModifyUser');
    }
}
else{
    header('Location: dashboard.php');
}