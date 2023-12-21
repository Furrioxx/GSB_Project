<?php
class tools{
    public function __construct()
    {
        
    } 

    public function displayFicheFrais($db,$role, $isTraite){
        $request = new request();
        if($role == 'visiteur'){
            //affichage des fiches frais dans un tableau
            foreach($request->getCostSheet($db, $_SESSION['idUser']) as $key => $value){
                //si les fiche frais ne sont pas traité
                if($value['statue'] == 'NT'){
                    $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-7" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M12 12l-2 3"></path><path d="M12 7v5"></path></svg>';
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['beginDate'].'</td><td>'.$value['endDate'].'</td><td>'.$value['montant_total'].' €</td><td>-</td><td>'.$icon.' En attente</td><td><form action="detailFicheFrais.php" method="post" class="d-flex flex-row-reverse"><input type="number" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display : none"><input type="submit" name ="seeFicheFrais" value ="Voir plus" class="btn btn-primary"></form></td><td><form action="detailFicheFrais.php" method="post" onsubmit="return validationDelete()"><input type="submit" name="deleteFicheFrais" value="Supprimer" class="btn btn-outline-danger"></form></td></tr>';
                }
                //si les fiche frais sont traité
                else if($value['statue'] == 'T'){
                    $ComptableInfo = $request->getComptableName($db, $value['idUserValidation']);
                    $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="green" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>';
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['beginDate'].'</td><td>'.$value['endDate'].'</td><td>'.$value['montant_total'].' €</td><td>'.$value['refund_total'].' €</td><td style="color:green;">'.$icon.' Traité par '.$ComptableInfo[0]['name']. ' ' .$ComptableInfo[0]['surname'].'</td><td><form action="detailFicheFrais.php" method="post"><input type="number" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display : none"><input type="submit" name ="seeFicheFrais" value ="Voir plus" class="btn btn-primary"></form></td></tr>';
                }
                
            }
        }


        
        else if ($role == 'comptable'){
            if($isTraite ==  'nt'){
                foreach($request->getCostSheetComptableNT($db) as $key => $value){
                    //si le visiteur n'a pas de pp
                    if($value['ppLink'] == ''){
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['beginDate'].'</td><td>'.$value['endDate'].'</td><td>'.$value['montant_total'].' €</td><td>'.$value['name']." ".$value['surname'].'</td><td><img src="../src/user.jpg" alt="user image" style="height:50px;"></td><td><form action="detailFicheFrais.php" method="post"><input type="number" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display : none"><input type="submit" name ="seeFicheFrais" value ="Voir plus" class="btn btn-primary"></form></td></tr>';
                    }
                    else{
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['beginDate'].'</td><td>'.$value['endDate'].'</td><td>'.$value['montant_total'].' €</td><td>'.$value['name']." ".$value['surname'].'</td><td><img src="'.$value['ppLink'].'" alt="user image" style="height:50px;"></td><td><form action="detailFicheFrais.php" method="post"><input type="number" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display : none"><input type="submit" name ="seeFicheFrais" value ="Voir plus" class="btn btn-primary"></form></td></tr>';
                    }
                    
                }
            }
            else{
                foreach($request->getCostSheetComptableT($db) as $key => $value){
                    //si le visiteur n'a pas de pp
                    if($value['ppLink'] == ''){
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['beginDate'].'</td><td>'.$value['endDate'].'</td><td>'.$value['montant_total'].' €</td><td>'.$value['refund_total'].' €</td><td>'.$value['name']." ".$value['surname'].'</td><td><img src="../src/user.jpg" alt="user image" style="height:50px;"></td><td><form action="detailFicheFrais.php" method="post"><input type="number" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display : none"><input type="submit" name ="seeFicheFrais" value ="Voir plus" class="btn btn-primary"></form></td></tr>';
                    }
                    else{
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['beginDate'].'</td><td>'.$value['endDate'].'</td><td>'.$value['montant_total'].' €</td><td>'.$value['refund_total'].' €</td><td>'.$value['name']." ".$value['surname'].'</td><td><img src="'.$value['ppLink'].'" alt="user image" style="height:50px;"></td><td><form action="detailFicheFrais.php" method="post"><input type="number" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display : none"><input type="submit" name ="seeFicheFrais" value ="Voir plus" class="btn btn-primary"></form></td></tr>';
                    }
                    
                }
            }
        }
    }

    public function displayUsers($db){
        $request = new request();
        foreach ($request->getAllUser($db) as $key => $value) {
            if($value['isActive'] == 1){
                $desactiveButton = '<button type="submit" name="desacBtn" class="btn btn-outline-danger">Désactiver</button>';
            }
            else{
                $desactiveButton = "";
            }
            if($value['ppLink'] == ''){
                echo '<tr><th scope="row">'.$value['id'].'</th><td>'.$value['name']." ".$value['surname'].'</td><td>'.$value['login'].'</td><td>'.$value['dateEmbauche'].'</td><td><img src="../src/user.jpg" alt="user image" style="height:50px;"></td><td><form action="optionUser.php" method="post" ><input type="number" value="'.$value['id'].'" name="idUser" style="display:none"><button type="submit" name="modifyBtn" class="btn btn-outline-secondary me-1">Modifier</button>'.$desactiveButton.'</form></td></tr>';
            }
            else{
                echo '<tr><th scope="row">'.$value['id'].'</th><td>'.$value['name']." ".$value['surname'].'</td><td>'.$value['login'].'</td><td>'.$value['dateEmbauche'].'</td><td><img src="'.$value['ppLink'].'" alt="user image" style="height:50px;"></td><td><form action="optionUser.php" method="post" ><input type="number" value="'.$value['id'].'" name="idUser" style="display:none"><button type="submit" name="modifyBtn" class="btn btn-outline-secondary me-1">Modifier</button>'.$desactiveButton.'</form></td></tr>';
            }
        }
    }

    // public function displayGoodForm($db, $idFrais){
    //     $request = new request();
    //     foreach ($request->getPreciseCost($db, $idFrais) as $key => $value) {
    //         if($value['libelle'] == "transport (voiture)"){
    //             echo '<div class="dbInfos flex-fill"> <h4>Valeur actuelle</h4> <div class="mt-3"> <input type="text" value="'.$value['timing'].' km" class="form-control" disabled> </div> </div> <div class="modifyInfo flex-fill"> <h4>Valeur à modifier</h4> <form action="updateFicheFrais.php" method="post" enctype="multipart/form-data"> <div class="mt-3"> <input type="number" name="newKmCar" placeholder="Entrez la nouvelle valeur" class="form-control" required> </div> <div class="mt-3"> <input type="submit" name ="submitUpdateFrais" value ="Modifier" class="btn btn-primary"> </div> <input type="text" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display: none;""> <input type="text" name="idFrais" value="'.$value['id'].'" style="display: none;""> <input type="text" name="actualLibelle" value="'.$value['libelle'].'" style="display: none;""> <input type="text" name="actualTiming" value="'.$value['timing'].'" style="display: none;""> <input type="text" name="actualMontant" value="'.$value['montant'].'" style="display: none;""><input type="text" name="actualLinkJustif" value="'.$value['linkJustif'].'" style="display: none;""></form> </div>';
    //         }
    //         else if($value['libelle'] == "transport (train)"){
    //             echo '<div class="dbInfos flex-fill"> <h4>Valeur actuelle</h4> <div class="mt-3"> <input type="text" value="'.$value['montant'].' €" class="form-control" disabled> </div> <div class="mt-3"> <img src="'.$value['linkJustif'].'" alt="justificatif" width="200px"> </div> </div> <div class="modifyInfo flex-fill"> <h4>Valeur à modifier</h4> <form action="updateFicheFrais.php" method="post" enctype="multipart/form-data"> <div class="mt-3"> <input type="number" name="newTrainMontant" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="file" name="newTrainJustif" id="newTrainJustif" class="form-control"> </div> <div class="mt-3"> <input type="submit" name ="submitUpdateFrais" value ="Modifier" class="btn btn-primary"> </div> <input type="text" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display: none;""><input type="text" name="idFrais" value="'.$value['id'].'" style="display: none;""> <input type="text" name="actualLibelle" value="'.$value['libelle'].'" style="display: none;""> <input type="text" name="actualTiming" value="'.$value['timing'].'" style="display: none;""> <input type="text" name="actualMontant" value="'.$value['montant'].'" style="display: none;""><input type="text" name="actualLinkJustif" value="'.$value['linkJustif'].'" style="display: none;""></form> </div>';
    //         }
    //         else if($value['libelle'] == "logement"){
    //             echo '<div class="dbInfos flex-fill"> <h4>Valeur actuelle</h4> <div class="mt-3"> <input type="text" value="'.$value['timing'].' nuits" class="form-control" disabled> </div> <div class="mt-3"> <input type="text" value="'.$value['montant'].' €" class="form-control" disabled> </div> </div> <div class="modifyInfo flex-fill"> <h4>Valeur à modifier</h4> <form action="updateFicheFrais.php" method="post" enctype="multipart/form-data"> <div class="mt-3"> <input type="number" name="newNuitsLogement" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="number" step="0.01" name="newPriceLogement" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="submit" name ="submitUpdateFrais" value ="Modifier" class="btn btn-primary"> </div><input type="text" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display: none;""><input type="text" name="idFrais" value="'.$value['id'].'" style="display: none;""><input type="text" name="actualLibelle" value="'.$value['libelle'].'" style="display: none;""> <input type="text" name="actualTiming" value="'.$value['timing'].'" style="display: none;""> <input type="text" name="actualMontant" value="'.$value['montant'].'" style="display: none;""><input type="text" name="actualLinkJustif" value="'.$value['linkJustif'].'" style="display: none;""> </form> </div>';
    //         }
    //         else if($value['libelle'] == "restauration"){
    //             echo '<div class="dbInfos flex-fill"> <h4>Valeur actuelle</h4> <div class="mt-3"> <input type="text" value="'.$value['timing'].' repas" class="form-control" disabled> </div> <div class="mt-3"> <input type="text" value="'.$value['montant'].' €" class="form-control" disabled> </div> </div> <div class="modifyInfo flex-fill"> <h4>Valeur à modifier</h4> <form action="updateFicheFrais.php" method="post" enctype="multipart/form-data"> <div class="mt-3"> <input type="number" name="newRepasRestauration" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="number" step="0.01" name="newPriceRestauration" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="submit" name ="submitUpdateFrais" value ="Modifier" class="btn btn-primary"> </div><input type="text" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display: none;""><input type="text" name="idFrais" value="'.$value['id'].'" style="display: none;""> <input type="text" name="actualLibelle" value="'.$value['libelle'].'" style="display: none;""> <input type="text" name="actualTiming" value="'.$value['timing'].'" style="display: none;""> <input type="text" name="actualMontant" value="'.$value['montant'].'" style="display: none;""><input type="text" name="actualLinkJustif" value="'.$value['linkJustif'].'" style="display: none;""></form> </div>';
    //         }
    //         //catégorie autre
    //         else{
    //             echo '<div class="dbInfos flex-fill"> <h4>Valeur actuelle</h4> <div class="mt-3"> <input type="text" value="'.$value['libelle'].'" class="form-control" disabled> </div> <div class="mt-3"> <input type="text" value="'.$value['montant'].' €" class="form-control" disabled> </div> <div class="mt-3"> <img src="'.$value['linkJustif'].'" alt="justificatif" width="200px"> </div> </div> <div class="modifyInfo flex-fill"> <h4>Valeur à modifier</h4> <form action="updateFicheFrais.php" method="post" enctype="multipart/form-data"> <div class="mt-3"> <input type="text" name="newLibelleOther" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="number" step="0.01" name="newPriceOther" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="file" name="newJustifOther" id="newJustifOther" class="form-control"> </div> <div class="mt-3"> <input type="submit" name ="submitUpdateFrais" value ="Modifier" class="btn btn-primary"> </div><input type="text" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display: none;""><input type="text" name="idFrais" value="'.$value['id'].'" style="display: none;""> <input type="text" name="actualLibelle" value="'.$value['libelle'].'" style="display: none;""> <input type="text" name="actualTiming" value="'.$value['timing'].'" style="display: none;""> <input type="text" name="actualMontant" value="'.$value['montant'].'" style="display: none;""><input type="text" name="actualLinkJustif" value="'.$value['linkJustif'].'" style="display: none;""></form> </div>' ;
    //         }
    //     }
    // }

    public function displayValidationHF($db, $idFicheFrais, $maxRefund1night, $maxRefund1meal ){
        $request = new  request();
        $allHFCost = $request->getAllHFCost($db, $idFicheFrais);
        if(count($allHFCost) == 2){
            echo '<div class="dbInfos flex-fill"> <p>Maximum remboursé pour une nuit : '.$maxRefund1night.' €</p> <h4>Montant renseigné</h4> <div class="mt-3"><label>'.$allHFCost[0]['libelle'].' : </label><input type="text" value="'.$allHFCost[0]['montant'].' €" class="form-control" disabled> </div> <div class="mt-3"><label>'.$allHFCost[1]['libelle'].' : </label><input type="text" value="'.$allHFCost[1]['montant'].' €" class="form-control" disabled> </div></div> <div class="modifyInfo flex-fill"> <p>Maximum remboursé pour un repas : '.$maxRefund1meal.' €</p> <h4>Montant à rembourser</h4> <form action="validateFrais.php" method="post" enctype="multipart/form-data"> <div class="mt-3"> <label></label><input type="number" name="refundMontantTransport" placeholder="Entrez le montant remboursé" class="form-control" required> </div> <div class="mt-3"> <label></label><input type="number" name="refundMontantOther" placeholder="Entrez le montant remboursé" class="form-control" required> </div> <div class="mt-3"> <input type="submit" name ="submitValidateFrais" value ="Valider" class="btn btn-primary"> </div> <input type="text" name="idFicheFrais" value="'.$idFicheFrais.'" style="display: none;""> </form></div>';
        }
        else if(count($allHFCost)== 1){
            if($allHFCost[0]['libelle'] == 'transport (train)'){
                $nameInput = "refundMontantTransport";
            }
            else{
                $nameInput = "refundMontantOther";
            }
            echo '<div class="dbInfos flex-fill"> <p>Maximum remboursé pour une nuit : '.$maxRefund1night.' €</p> <h4>Montant renseigné</h4> <div class="mt-3"><label>'.$allHFCost[0]['libelle'].' : </label><input type="text" value="'.$allHFCost[0]['montant'].' €" class="form-control" disabled> </div> </div> <div class="modifyInfo flex-fill"> <p>Maximum remboursé pour un repas : '.$maxRefund1meal.' €</p> <h4>Montant à rembourser</h4> <form action="validateFrais.php" method="post" enctype="multipart/form-data"> <div class="mt-3"> <label></label><input type="number" name="'.$nameInput.'" placeholder="Entrez le montant remboursé" class="form-control" required> </div> <div class="mt-3"> <input type="submit" name ="submitValidateFrais" value ="Valider" class="btn btn-primary"> </div> <input type="text" name="idFicheFrais" value="'.$idFicheFrais.'" style="display: none;""> </form></div>';
        }
        else{
            echo '<form action="validateFrais.php" method="post" enctype="multipart/form-data"><p>Maximum remboursé pour une nuit : '.$maxRefund1night.' €</p><p>Maximum remboursé pour un repas : '.$maxRefund1meal.' €</p><div class="mt-3"> <input type="submit" name ="submitValidateFrais" value ="Valider" class="btn btn-primary"> </div> <input type="text" name="idFicheFrais" value="'.$idFicheFrais.'" style="display: none;""></form>';
        }
        
    }

    public function validateFrais($db, $idFicheFrais, $refundMontantTrain, $refundMontantOther){
        $request = new request();
        $allFrais = $request->getAllCost($db, $idFicheFrais);
        foreach ($allFrais as $key => $value) {
            if($value['libelle'] == 'transport (voiture)'){
                $request->setRefundMontant($db, $value['id'], $value['montant']);
            }
            else if ($value['libelle'] == 'transport (train)'){
                $request->setRefundMontant($db, $value['id'], $refundMontantTrain);
            }
            else if($value['libelle'] == 'logement'){
                $refundMontant = self::maxRefundMontant($value['libelle'], $value['timing'], $value['montant'], $db);
                $request->setRefundMontant($db, $value['id'], $refundMontant);
            }
            else if ($value['libelle'] == 'restauration'){
                $refundMontant = self::maxRefundMontant($value['libelle'], $value['timing'], $value['montant'], $db);
                $request->setRefundMontant($db, $value['id'], $refundMontant);
            }
            else{
                $request->setRefundMontant($db, $value['id'], $refundMontantOther);
            }
        }
        $request->updateValidateCostSheet($db, $idFicheFrais, $_SESSION['idUser']);

    }

    public function maxRefundMontant($libelle, $timing, $montant, $db){
        $request = new request();
        $allMaxRefund = $request->getMaxPriceRefund($db);
        foreach ($allMaxRefund as $key => $value) {
            if($value['nomPrice'] == 'logement'){
                $maxPrice1night = $value['maxPrice'];
            }
            else if ($value['nomPrice'] == 'restauration'){
                $maxPrice1Meal =  $value['maxPrice'];
            }
        }
        if($libelle == 'logement'){
            if($montant == 0){
                return $montant;
            }
            else if($montant / $timing <= $maxPrice1night){
                return $montant;
            }
            
            else{
                return $maxPrice1night * $timing;
            }
        }
        else if($libelle == 'restauration'){
            if($montant == 0){
                return $montant;
            }
            else if($montant / $timing <= $maxPrice1Meal){
                return $montant;
            }
            else{
                return $maxPrice1Meal * $timing;
            }
        }
    }

    public function displayAllFraisVisiteur($db, $idFicheFrais){
        $request = new request();
        $allFrais = $request->getAllCost($db, $idFicheFrais);
        foreach ($allFrais as $key => $value) {
            $montantTotal =  $value['montant_total'];
            //si la fiche frais n'est pas traité
            if($_SESSION['statut'] == 'visiteur'){
                $isModifyButton = '<td><form action="preciseFrais.php" method="post"><input type="number" name="idFrais" value="'.$value['id'].'" style="display : none"><input name="libelleFrais" type="text" value="'.$value['libelle'].'" style="display : none"><input type="submit" name ="updateFrais" value ="Modifier" class="btn btn-primary"> <input type="submit" name ="deleteFrais" value ="Supprimer" class="btn btn-outline-danger"></form></td>';
            }
            else{
                $isModifyButton = '';
            }
            if($value['statue'] == 'NT'){
                $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-7" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M12 12l-2 3"></path><path d="M12 7v5"></path></svg>';
                $isTraité = "<span> En attente</span>";
                $refundMontant = "-";
                //si le frais est forfaitaire
                if($value['statu'] == "F"){
                    if($value['linkJustif'] != ''){
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].'</td><td>-</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td>'.$isModifyButton.'</tr>';
                    }
                    else{
                        if($value['libelle'] == "transport (voiture)"){
                            echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].' km</td><td>'.$value['montant'].' €</td><td>-</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td>-</td><td>'.$isModifyButton.'</td></tr>';
                        }
                        else if($value['libelle'] == "logement"){
                            echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].' nuits</td><td>'.$value['montant'].' €</td><td>-</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td>-</td><td>'.$isModifyButton.'</td></tr>';
                        }
                        else if($value['libelle'] == "restauration"){
                            echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].' repas</td><td>'.$value['montant'].' €</td><td>-</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td>-</td><td>'.$isModifyButton.'</td></tr>';
                        }
                        else{
                            echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].' €</td><td>-</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td>-</td><td>'.$isModifyButton.'</td></tr>';
                        }
                    }
                }
                else{
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].' €</td><td>-</td><td>'.$value['dateligne'].'</td><td>Hors Forfait</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td><td>'.$isModifyButton.'</td></tr>';
                }
            }
            else{
                $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="green" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>';
                $isTraité = "<span style='color:green;'> Traité</span>";
                $refundMontant = $value['refund_total'] . " €";
                if($value['statu'] == "F"){
                    if($value['linkJustif'] != ''){
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].' €</td><td>'.$value['refund_montant'].' €</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td></tr>';
                    }
                    else{
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].' €</td><td>'.$value['refund_montant'].' €</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td>-</td></tr>';
                    }
                }
                else{
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].' €</td><td>'.$value['refund_montant'].' €</td><td>'.$value['dateligne'].'</td><td>Hors Forfait</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td></tr>';
                }
            }
        }
        echo "<p class='mb-3'>Montant total : ".$montantTotal." €</p>";
        echo "<p class='mb-3'>Montant Remboursé : ".$refundMontant."</p>";
        echo "<p class='mb-3'>Etat de la fiche frais : ".$icon.$isTraité."</p>";      
    }

    public function downloadImage($destPath, $inputName){
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]["error"] == 0) {
            // Vérifier le type MIME du fichier
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            $fileType = $_FILES[$inputName]["type"];

            if (in_array($fileType, $allowedTypes)) {
                // Le fichier est une image du type autorisé

                // Définir le dossier de destination sur votre serveur
                $uploadDir = $destPath;

                // Si le dossier n'existe pas, le créer
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Récupérer les informations sur le fichier téléchargé
                $fileName = str_replace("'", "", basename($_FILES[$inputName]["name"]));
                $targetFilePath = $uploadDir . $fileName;

                // Déplacer le fichier téléchargé vers le dossier de destination
                if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetFilePath)) {
                    echo "Le fichier a été téléchargé avec succès.";
                } else {
                    echo "Une erreur s'est produite lors du téléchargement du fichier.";
                }
            } else {
                echo "Erreur : Seuls les fichiers JPEG, PNG et JPG sont autorisés.";
            }
        } else {
            echo "Erreur : Veuillez sélectionner un fichier valide.";
        }

        return $uploadDir .  "" . $fileName;
    }

    public function calculPriceCar($db,$kmTransport){
        $request = new request();
        $CVCarUser = $request->getCvCarUser($db, $_SESSION['idUser'])['cvcar'];
        if($kmTransport <= 5000){
            if($CVCarUser <= 3){
                $cost = 0.529*$kmTransport;
            }
            else if ($CVCarUser == 4){
                $cost = 0.606*$kmTransport;
            }
            else if ($CVCarUser == 5){
                $cost = 0.636*$kmTransport;
            }
            else if ($CVCarUser == 6){
                $cost = 0.665*$kmTransport;
            }
            else if ($CVCarUser >= 7){
                $cost = 0.697*$kmTransport;
            }
        }
        else if($kmTransport > 5000 &&  $kmTransport <= 20000){
            if($CVCarUser <= 3){
                $cost = 0.316*$kmTransport + 1061;
            }
            else if ($CVCarUser == 4){
                $cost = 0.340*$kmTransport + 1330;
            }
            else if ($CVCarUser == 5){
                $cost = 0.356*$kmTransport + 1391;
            }
            else if ($CVCarUser == 6){
                $cost = 0.374*$kmTransport + 1457;
            }
            else if ($CVCarUser >= 7){
                $cost = 0.394*$kmTransport + 1512;
            }
        }
        else if($kmTransport > 20000){
            if($CVCarUser <= 3){
                $cost = 0.369*$kmTransport;
            }
            else if ($CVCarUser == 4){
                $cost = 0.408*$kmTransport;
            }
            else if ($CVCarUser == 5){
                $cost = 0.427*$kmTransport;
            }
            else if ($CVCarUser == 6){
                $cost = 0.448*$kmTransport;
            }
            else if ($CVCarUser >= 7){
                $cost = 0.470*$kmTransport;
            }
        }

        return round($cost, 2);
    }

    public function verifRefundMontant($db, $refundMontantOther, $refundMontantTransport, $idFicheFrais){
        $request = new request();
        $allcost = $request->getAllCost($db, $idFicheFrais);
        if($refundMontantOther != null || $refundMontantTransport != null){
            foreach ($allcost as $key => $value) {
                if($value['libelle'] == 'transport (train)'){
                    if($refundMontantTransport > $value['montant']){
                        echo 'test';
                        return false;
                    }
                }
                else{
                    if($refundMontantOther > $value['montant']){
                        return false;
                    }
                }
            } 
            return true;
        }
        else{
            return true;
        }
    }

    public function displayProfilePP($db){
        $request = new request();
        $userPP = $request->isTherePp($db);
        foreach ($userPP as $key => $value) {
            if($value['ppLink'] != ''){
                echo '<div class="imgContainer mb-3"><img src="'.$value['ppLink'].'" alt="photo de profile" class="modify-user-pp"><div class="hoverPP"><img src="../src/pencil.png"></div></div><div>';
            }
            else{
                echo '<div class="imgContainer mb-3"><img src="../src/user.jpg" alt="user image" class="modify-user-pp"><div class="hoverPP"><img src="../src/pencil.png"></div></div>';
            }
        }
    }

    public function isCostSheetNotTraite($db, $idFicheFrais){
        $request = new request();
        $result = $request->getpreciseCostSheet($db, $idFicheFrais);
        foreach ($result as $key => $value) {
            if($value['statue'] == 'NT'){
                return true;
            }
            else{
                return false;
            }
        }
    }

    public function displayFraisMonth($db, $month){
        $request = new request();
        $result = $request->getAllPriceMonth($db, $month);
         //si aucun frais n'a été remplie durant le mois
        if(empty($result)){
            echo '<tr><td colspan="6">Aucune fiche frais n\'a été remplie ce mois ci</td></tr>';
        }
        else{
            foreach($result as $key => $value){
                if($value['statu'] == 'F'){
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].' €</td><td>'.$value['refund_montant'].'</td><td>Forfaitarisé</td></tr>';
                }
                else{
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].'</td><td>'.$value['refund_montant'].'</td><td>Hors Forfait</td></tr>';
                }
            } 
        }
        
    }

    public function display_total_refund_month($db, $month){
        $request = new request();
        $sumCost = $request->getSumCostMonth($db, $month);
        switch($month){
            case "1":
                $theMonth = "janvier";
                break;
            case "2":
                $theMonth = "février";
                break;
            case "3":
                $theMonth = "mars";
                break;
            case "4":
                $theMonth = "avril";
                break;
            case "5":
                $theMonth = "mai";
                break;
            case "6":
                $theMonth = "juin";
                break;
            case "7":
                $theMonth = "juillet";
                break;
            case "8":
                $theMonth = "aout";
                break;
            case "9":
                $theMonth = "septembre";
                break;
            case "10":
                $theMonth = "octobre";
                break;
            case "11":
                $theMonth = "novembre";
                break;
            case "12":
                $theMonth = "décembre";
                break;    
        }
        foreach($sumCost as $key => $value){
            echo '<div class ="mb-3">Le montant total de remboursment du mois de '.$theMonth.' est de : ' . round($value['total_refund_montant'], 2) . ' €</div>';
        }
    }

    public function sendMail($tempMdp, $to, $name, $surname){
        $to = $to; 
        $subject = "MOT DE PASSE TEMPORAIRE"; 
        $content = "Mr. Mme. \r\n".$name. " " .$surname."\r\n \r\n Vous trouverez ci-dessous les identifiants pour vous connecter à votre espace GSB : \r\n - ". $to. "\r\n - " . $tempMdp;
        $message = wordwrap($content, 70, "\r\n");
        $headers = "From: no-reply-Admin-GSB <contact@tom-pelud.fr>\r\n";

        if (mail($to, $subject, $message, $headers))
        echo "The email has been sent successfully!";
        else
        echo "Email did not leave correctly!";
    }
    
    public function getDataForCharts($db){
        $request = new request();
        $datas = $request->getChartMontant($db);
        return $datas;
    }
}