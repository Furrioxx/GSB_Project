<?php
$servername = "localhost";
$dbname = "gsb";
$username = "root";
$password = "";


try{
    $db = new PDO('mysql:host='. $servername .';dbname='. $dbname . ';charset=utf8', '' . $username . '' , '' . $password . '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>