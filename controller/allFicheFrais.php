<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');

if(isset($_SESSION['name'])){
    $title = "Bonjour " .   $_SESSION['name'];
    include('../vue/pageAllFicheFrais.php');
}
else{
    header('Location: dashboard.php');
}