<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');

if(isset($_SESSION['name'])){
    $title = "Bonjour " .   $_SESSION['name'];
    if(isset($_POST['changeMonth'])){
       $isMonthSelected = $_POST['month']; 
       
    }
    else{
        $isMonthSelected = false;
    }
    include('../vue/pageAllFraisMonth.php');
}
else{
    header('Location: dashboard.php');
}