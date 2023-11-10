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

    public function createFicheFrais($db){
        $query = "INSERT INTO cost_sheet VALUES(null, 0, '".date('Y-m-d')."', '".$_SESSION['idUser']."')";
        $result = $db->prepare($query);
        $result->execute();
        return $result;
    }
    
    public function insertFraisNotInclued($db){
        //insert whith idCostSheet == getCostSheetID($db)
        $request = new request();
        $idSheet = $request->getCostSheetID($db);
        foreach ($idSheet as $key => $value) {
            $query = "INSERT INTO cost_not_inclued VALUES(null, '".$_POST['libelle']."', '".$_POST['montant']."', '".$_POST['date']."', '".$value['idFicheFrais']."')";
        }
        $result = $db->prepare($query);
        $result->execute();
    }

    public function insertFraisInclued($db){

    }

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


    public function getCostNotInclued($db){
        $request = new request();
        $costSheetID = $request->getCostSheetID($db);
        foreach ($costSheetID as $key => $value) {
            $query = "SELECT * FROM cost_not_inclued WHERE idFicheFrais = '".$value['idFicheFrais']."'";
        }
        
        $result = $db->prepare($query);
        $result->execute();
        $resultArray =$result->fetchAll();
        return $resultArray;
    }

    public function getCostInclued($db){
        $request = new request();
        $costSheetID = $request->getCostSheetID($db);
        foreach ($costSheetID as $key => $value) {
            $query = "SELECT * FROM cost_inclued WHERE idFicheFrais = '".$value['idFicheFrais']."'";
        }
        $result = $db->prepare($query);
        $result->execute();
        $resultArray =$result->fetchAll();
        return $resultArray;
    }
}

?>