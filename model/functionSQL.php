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

    // public function insertFraisNotInclued($db){
    //     //insert whith idCostSheet == getCostSheetID($db)
    //     $request = new request();
    //     $idSheet = $request->getCostSheetID($db);
    //     foreach ($idSheet as $key => $value) {
    //         $query = "INSERT INTO cost_not_inclued VALUES(null, '".$_POST['libelle']."', '".$_POST['montant']."', '".$_POST['date']."', '".$value['idFicheFrais']."')";
    //     }
    //     $result = $db->prepare($query);
    //     $result->execute();
    // }

    // public function insertFraisInclued($db){

    // }

    public function getCostSheetID($db){
        //select where id user === session id
        $query = "SELECT * FROM cost_sheet WHERE idUser = '".$_SESSION['idUser']."'";
        $result = $db->prepare($query);
        $result->execute();
        //select id cost sheet where date dans db == le meme mois date php
        $actualDate = date("Y-m");
        foreach ($result as $key => $value) {
            $dateDB = substr($value['mois'], 0, -3);
            if($dateDB == $actualDate){
                $goodDate = $value['mois'];
            }
            else{

            }
        }

        $query = "SELECT idFicheFrais FROM cost_sheet WHERE mois = '".$goodDate."'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
        //si elle existe pas alors creer un nouvvelle fiche frais avec session id user

    }


    // public function getCostNotInclued($db){
    //     $request = new request();
    //     $costSheetID = $request->getCostSheetID($db);
    //     foreach ($costSheetID as $key => $value) {
    //         $query = "SELECT * FROM cost_not_inclued WHERE idFicheFrais = '".$value['idFicheFrais']."'";
    //     }
        
    //     $result = $db->prepare($query);
    //     $result->execute();
    //     $resultArray =$result->fetchAll();
    //     return $resultArray;
    // }

    // public function getCostInclued($db){
    //     $request = new request();
    //     $costSheetID = $request->getCostSheetID($db);
    //     foreach ($costSheetID as $key => $value) {
    //         $query = "SELECT * FROM cost_inclued WHERE idFicheFrais = '".$value['idFicheFrais']."'";
    //     }
    //     $result = $db->prepare($query);
    //     $result->execute();
    //     $resultArray =$result->fetchAll();
    //     return $resultArray;
    // }
}

?>