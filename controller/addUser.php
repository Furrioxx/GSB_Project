<?php
session_start();
include('../model/functionSQL.php');
include('../model/config.php');

if(isset($_POST['submit'])){
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

    header('Location: dashboard.php');
}
else{
    header('Location: dashboard.php');
}
?>