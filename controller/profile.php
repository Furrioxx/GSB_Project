<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');
include('tools.php');

if(isset($_SESSION['name'])){
    include('../vue/pageProfil.php');
}
else{
    header('Location: dashboard.php');
}