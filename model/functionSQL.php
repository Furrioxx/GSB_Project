<?php

use LDAP\Result;

include('config.php');

$fucntionSQL = new request();

class request{
    public function getUser($db){
        $sql1 = "SELECT * FROM users WHERE login = '".$_POST['mail']."'";
        $result = $db->prepare($sql1);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }
    
}

?>