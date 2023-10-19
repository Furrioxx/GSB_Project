<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gsb";
$option = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
try{
    $db = new PDO('mysql:host='. $servername .';dbname='. $dbname . ';charset=utf8', '' . $username . '' , '' . $password . '', $option);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>