<?php
session_start();
include('../model/functionSQL.php');
include('../model/config.php');
include('../controller/tools.php');

if(isset($_SESSION['err-addUser'])){
    unset($_SESSION['err-addUser']);
}

if(isset($_SESSION['name'])){
    if(isset($_POST['submit'])){
        if(!empty($_POST['nameUser']) && !empty($_POST['surnameUser']) && !empty($_POST['loginUser']) && !empty($_POST['adressUser']) && !empty($_POST['cpUser']) && !empty($_POST['villeUser']) && !empty($_POST['dateUser']) && !empty($_POST['statutUser']) && !empty($_POST['cvCarUser'])){
            $nameUser = $_POST['nameUser'];
            $surnameUser = $_POST['surnameUser'];
            $loginUser = $_POST['loginUser'];
            $adressUser = $_POST['adressUser'];
            $cpUser = $_POST['cpUser'];
            $villeUser = $_POST['villeUser'];
            $dateUser = $_POST['dateUser'];
            $statutUser = $_POST['statutUser'];
            $cvCarUser = $_POST['cvCarUser'];
        
            $request = new request();
            $tempPassword = $request->addUser($db, $nameUser,$surnameUser, $loginUser, $adressUser, $cpUser, $villeUser, $dateUser, $statutUser, $cvCarUser);
            $tools = new tools();
            $tools->sendMail($tempPassword[0], $tempPassword[1], $tempPassword[2], $tempPassword[3]);
        
            $_SESSION['popUpAddUser'] = true;
            header('Location: dashboard.php');
        }
        else{
            $_SESSION['err-addUser'] = "Tous les champs n'ont pas été remplies";
            header('Location: controllerAddUser.php');
        }
        
    }
    else{
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}

?>