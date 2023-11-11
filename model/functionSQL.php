<?php

include('config.php');

class request{
    
    public function __construct()
    {
        
    }

    public function getUser($db){
        $sql1 = "SELECT * FROM users WHERE login = '".$_POST['mail']."'";
        $result = $db->prepare($sql1);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }

    public function createFicheFrais($db,$beginDate, $endDate){
        $query = "INSERT INTO cost_sheet VALUES(null, 0, '".$beginDate."', '".$endDate."' ,'".$_SESSION['idUser']."', 'NT')";
        $result = $db->prepare($query);
        $result->execute();
        $query2 = "SELECT * FROM cost_sheet WHERE idUser = '".$_SESSION['idUser']."'";
        $result2 = $db->prepare($query2);
        $result2->execute();
        $test = $result2->fetchAll();
        return $test[count($test)-1]['idFicheFrais'];
    }

    public function getCvCarUser($db){
        $query = "SELECT cvcar FROM users WHERE id = '".$_SESSION['idUser']."'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetch();
        return $resultArray;
    }
    


    public function sendFrais($db, $id, $libelle, $montant, $timing ,$dateligne, $idficheFrais, $statu){
        //statu cost = frais ou hors frais
        $query = "INSERT INTO cost VALUES('".$id."','".$libelle."','".$montant."', '".$timing."' ,'".$dateligne."','".$idficheFrais."','".$statu."')";
        $result = $db->prepare($query);
        $result->execute();
    }  
    
    public function updatePriceCostSheet($db, $idFicheFrais){
        $query = "SELECT SUM(montant) as total_price FROM cost WHERE idFicheFrais = '".$idFicheFrais."'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetch();
        $query = "UPDATE cost_sheet SET montant = '".$resultArray['total_price']."' WHERE idFicheFrais = '".$idFicheFrais."'";
        $result = $db->prepare($query);
        $result->execute();
    }

    public  function getCostSheet($db){
        $query = "SELECT * FROM cost_sheet WHERE idUser =  '".$_SESSION['idUser']."'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }
}

?>