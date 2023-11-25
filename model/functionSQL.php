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

    public function getComptableName($db, $idUser){
        $query = "SELECT * FROM users WHERE id = '".$idUser."'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }

    public function isTherePp($db){
        $sql1 = "SELECT * FROM users WHERE id = '".$_SESSION['idUser']."'";
        $result = $db->prepare($sql1);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }

    public function createFicheFrais($db,$beginDate, $endDate){
        $query = "INSERT INTO cost_sheet VALUES(null, 0, 0,'".$beginDate."', '".$endDate."' ,'".$_SESSION['idUser']."', null ,  'NT')";
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
    


    public function sendFrais($db, $id, $libelle, $montant, $timing ,$dateligne, $idficheFrais, $statu, $justif){
        $query = "INSERT INTO cost VALUES('".$id."','".$libelle."','".$montant."', null , '".$timing."' ,'".$dateligne."','".$idficheFrais."','".$statu."', '".$justif."')";
        $result = $db->prepare($query);
        $result->execute();
    }  
    
    public function updatePriceCostSheet($db, $idFicheFrais){
        $query = "SELECT SUM(montant) as total_price FROM cost WHERE idFicheFrais = '".$idFicheFrais."'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetch();
        $query = "UPDATE cost_sheet SET montant_total = '".$resultArray['total_price']."' WHERE idFicheFrais = '".$idFicheFrais."'";
        $result = $db->prepare($query);
        $result->execute();
    }

    public function updateValidateCostSheet($db, $idFicheFrais, $idUserValidation){
        $query = "SELECT SUM(refund_montant) as total_refund_montant FROM cost WHERE idFicheFrais = '".$idFicheFrais."'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetch();
        $query = "UPDATE cost_sheet SET refund_total = '".$resultArray['total_refund_montant']."', statue = 'T' , idUserValidation = '".$idUserValidation."' WHERE idFicheFrais = '".$idFicheFrais."'";
        $result = $db->prepare($query);
        $result->execute();
    }

    public  function getCostSheet($db){
        $query = "SELECT * FROM cost_sheet WHERE idUser =  '".$_SESSION['idUser']."' ORDER BY endDate DESC";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }

    public function getpreciseCostSheet($db, $idFicheFrais){
        $query = "SELECT statue FROM cost_sheet WHERE idFicheFrais = '".$idFicheFrais."'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }

    public function getCostSheetComptableNT($db){
        $query = "SELECT idFicheFrais, montant_total, beginDate, endDate, statue, surname, `name`, ppLink FROM cost_sheet INNER JOIN users ON cost_sheet.idUser = users.id WHERE statue = 'NT'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }

    public function getCostSheetComptableT($db){
        $query = "SELECT idFicheFrais, montant_total, refund_total , beginDate, endDate, statue, surname, `name`, ppLink FROM cost_sheet INNER JOIN users ON cost_sheet.idUser = users.id WHERE statue = 'T'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }

    public function getAllCost($db, $idFicheFrais){
        $query = "SELECT id, libelle, montant, refund_montant, timing, dateligne, statu, linkJustif , montant_total, refund_total ,  statue FROM cost INNER JOIN cost_sheet ON cost.idFicheFrais = cost_sheet.idFicheFrais WHERE cost.idFicheFrais = '".$idFicheFrais."'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }

    public function getAllHFCost($db, $idFicheFrais){
        $query = "SELECT * FROM cost WHERE idFicheFrais = '".$idFicheFrais."' AND statu = 'HF'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }

    public function getPreciseCost($db, $idFrais){
        $query = "SELECT * FROM cost WHERE id = '".$idFrais."'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }

    public function tempPasswordGen($length){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!?';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
     
        return $randomString;
    }

    public function addUser($db, $nameUser, $surnameUser, $loginUser, $adressUser, $cpUser, $villeUser, $dateUser, $statutUser, $cvCarUser){
        $tempPassword = self::tempPasswordGen(8);
        $query = "INSERT INTO users VALUES(null, '".$surnameUser."', '".$nameUser."', '".$loginUser."', '".$tempPassword."', '".$adressUser."', '".$cpUser."', '".$villeUser."', '".$dateUser."', '".$statutUser."', '".$cvCarUser."', '', '1')";
        $result = $db->prepare($query);
        $result->execute();
        return $tempPassword;
    }

    public function getAllUser($db){
        $query = "SELECT * FROM users WHERE statut = 'visiteur' OR statut = 'comptable'";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }

    public function updatePassword($db, $newPassword, $id){
        $query = "UPDATE users SET password = '".$newPassword."' WHERE id = '".$id."'";
        $result = $db->prepare($query);
        $result->execute();
    }
    
    public function updateFrais($db, $libelle, $cost ,$timing, $linkJustif, $idFrais){
        $query = "UPDATE cost SET montant = '".$cost."', timing = '".$timing."', libelle = '".$libelle."', linkJustif = '".$linkJustif."' WHERE id = '".$idFrais."'";
        $result = $db->prepare($query);
        $result->execute();
    }

    public function setRefundMontant($db, $idFrais, $refundMontant){
        $query = "UPDATE cost SET refund_montant ='" .$refundMontant."' WHERE id='".$idFrais."'";
        $result = $db->prepare($query);
        $result->execute();
    }
    public function updatePP($db, $path, $idUser){
        $query="UPDATE users SET ppLink = '".$path."' WHERE id = '".$idUser."'";
        $result = $db->prepare($query);
        $result->execute();
    }

    public function desactiveUser($db, $idUser){
        $query = "UPDATE users SET isActive = 0 WHERE id = '".$idUser."'";
        $result = $db->prepare($query);
        $result->execute();
    }

    public function updateProfile($db, $idUser, $whatToUpdate, $value){
        $query = "UPDATE users SET `$whatToUpdate` = '".$value."' WHERE id = '".$idUser."'";
        $result = $db->prepare($query);
        $result->execute();
    }

    public function getMaxPriceRefund($db){
        $query = "SELECT * FROM prices";
        $result = $db->prepare($query);
        $result->execute();
        $resultArray = $result->fetchAll();
        return $resultArray;
    }
}

?>