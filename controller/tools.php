<?php
class tools{
    public function __construct()
    {
        
    } 

    public function displayFicheFrais($db,$role){
        $request = new request();
        if($role == 'visiteur'){
            //affichage des fiches frais dans un tableau
            foreach($request->getCostSheet($db) as $key => $value){
                //si les fiche frais ne sont pas traité
                if($value['statue'] == 'NT'){
                    $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-7" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M12 12l-2 3"></path><path d="M12 7v5"></path></svg>';
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['beginDate'].'</td><td>'.$value['endDate'].'</td><td>'.$value['montant_total'].' €</td><td>-</td><td>'.$icon.' En attente</td><td><form action="detailFicheFrais.php" method="post"><input type="number" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display : none"><input type="submit" name ="seeFicheFrais" value ="Voir plus" class="btn btn-primary"></form></td></tr>';
                }
                //si les fiche frais sont accepté
                else if($value['statue'] == 'A'){

                }
                //si les fiche frais sont refusées
                else if($value['statue'] == 'R'){
                    
                }
            }
        }
        else if ($role == 'comptable'){
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
    }

    public function displayUsers($db){
        $request = new request();
        foreach ($request->getAllUser($db) as $key => $value) {
            if($value['ppLink'] == ''){
                echo '<tr><th scope="row">'.$value['id'].'</th><td>'.$value['name']." ".$value['surname'].'</td><td>'.$value['login'].'</td><td>'.$value['dateEmbauche'].'</td><td><img src="../src/user.jpg" alt="user image" style="height:50px;"></td></tr>';
            }
            else{
                echo '<tr><th scope="row">'.$value['id'].'</th><td>'.$value['name']." ".$value['surname'].'</td><td>'.$value['login'].'</td><td>'.$value['dateEmbauche'].'</td><td><img src="'.$value['ppLink'].'" alt="user image" style="height:50px;"></td></tr>';
            }
        }
    }

    public function displayGoodForm($db, $idFrais){
        $request = new request();
        foreach ($request->getPreciseCost($db, $idFrais) as $key => $value) {
            if($value['libelle'] == "transport (voiture)"){
                echo '<div class="dbInfos flex-fill"> <h4>Valeur actuelle</h4> <div class="mt-3"> <input type="text" value="'.$value['timing'].' km" class="form-control" disabled> </div> </div> <div class="modifyInfo flex-fill"> <h4>Valeur à modifier</h4> <form action="updateFicheFrais.php" method="post" enctype="multipart/form-data"> <div class="mt-3"> <input type="number" name="newKmCar" placeholder="Entrez la nouvelle valeur" class="form-control" required> </div> <div class="mt-3"> <input type="submit" name ="submitUpdateFrais" value ="Modifier" class="btn btn-primary"> </div> <input type="text" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display: none;""> <input type="text" name="idFrais" value="'.$value['id'].'" style="display: none;""> <input type="text" name="actualLibelle" value="'.$value['libelle'].'" style="display: none;""> <input type="text" name="actualTiming" value="'.$value['timing'].'" style="display: none;""> <input type="text" name="actualMontant" value="'.$value['montant'].'" style="display: none;""><input type="text" name="actualLinkJustif" value="'.$value['linkJustif'].'" style="display: none;""></form> </div>';
            }
            else if($value['libelle'] == "transport (train)"){
                echo '<div class="dbInfos flex-fill"> <h4>Valeur actuelle</h4> <div class="mt-3"> <input type="text" value="'.$value['montant'].' €" class="form-control" disabled> </div> <div class="mt-3"> <img src="'.$value['linkJustif'].'" alt="justificatif" width="200px"> </div> </div> <div class="modifyInfo flex-fill"> <h4>Valeur à modifier</h4> <form action="updateFicheFrais.php" method="post" enctype="multipart/form-data"> <div class="mt-3"> <input type="number" name="newTrainMontant" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="file" name="newTrainJustif" id="newTrainJustif" class="form-control"> </div> <div class="mt-3"> <input type="submit" name ="submitUpdateFrais" value ="Modifier" class="btn btn-primary"> </div> <input type="text" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display: none;""><input type="text" name="idFrais" value="'.$value['id'].'" style="display: none;""> <input type="text" name="actualLibelle" value="'.$value['libelle'].'" style="display: none;""> <input type="text" name="actualTiming" value="'.$value['timing'].'" style="display: none;""> <input type="text" name="actualMontant" value="'.$value['montant'].'" style="display: none;""><input type="text" name="actualLinkJustif" value="'.$value['linkJustif'].'" style="display: none;""></form> </div>';
            }
            else if($value['libelle'] == "logement"){
                echo '<div class="dbInfos flex-fill"> <h4>Valeur actuelle</h4> <div class="mt-3"> <input type="text" value="'.$value['timing'].' nuits" class="form-control" disabled> </div> <div class="mt-3"> <input type="text" value="'.$value['montant'].' €" class="form-control" disabled> </div> </div> <div class="modifyInfo flex-fill"> <h4>Valeur à modifier</h4> <form action="updateFicheFrais.php" method="post" enctype="multipart/form-data"> <div class="mt-3"> <input type="number" name="newNuitsLogement" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="number" step="0.01" name="newPriceLogement" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="submit" name ="submitUpdateFrais" value ="Modifier" class="btn btn-primary"> </div><input type="text" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display: none;""><input type="text" name="idFrais" value="'.$value['id'].'" style="display: none;""><input type="text" name="actualLibelle" value="'.$value['libelle'].'" style="display: none;""> <input type="text" name="actualTiming" value="'.$value['timing'].'" style="display: none;""> <input type="text" name="actualMontant" value="'.$value['montant'].'" style="display: none;""><input type="text" name="actualLinkJustif" value="'.$value['linkJustif'].'" style="display: none;""> </form> </div>';
            }
            else if($value['libelle'] == "restauration"){
                echo '<div class="dbInfos flex-fill"> <h4>Valeur actuelle</h4> <div class="mt-3"> <input type="text" value="'.$value['timing'].' repas" class="form-control" disabled> </div> <div class="mt-3"> <input type="text" value="'.$value['montant'].' €" class="form-control" disabled> </div> </div> <div class="modifyInfo flex-fill"> <h4>Valeur à modifier</h4> <form action="updateFicheFrais.php" method="post" enctype="multipart/form-data"> <div class="mt-3"> <input type="number" name="newRepasRestauration" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="number" step="0.01" name="newPriceRestauration" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="submit" name ="submitUpdateFrais" value ="Modifier" class="btn btn-primary"> </div><input type="text" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display: none;""><input type="text" name="idFrais" value="'.$value['id'].'" style="display: none;""> <input type="text" name="actualLibelle" value="'.$value['libelle'].'" style="display: none;""> <input type="text" name="actualTiming" value="'.$value['timing'].'" style="display: none;""> <input type="text" name="actualMontant" value="'.$value['montant'].'" style="display: none;""><input type="text" name="actualLinkJustif" value="'.$value['linkJustif'].'" style="display: none;""></form> </div>';
            }
            //catégorie autre
            else{
                echo '<div class="dbInfos flex-fill"> <h4>Valeur actuelle</h4> <div class="mt-3"> <input type="text" value="'.$value['libelle'].'" class="form-control" disabled> </div> <div class="mt-3"> <input type="text" value="'.$value['montant'].' €" class="form-control" disabled> </div> <div class="mt-3"> <img src="'.$value['linkJustif'].'" alt="justificatif" width="200px"> </div> </div> <div class="modifyInfo flex-fill"> <h4>Valeur à modifier</h4> <form action="updateFicheFrais.php" method="post" enctype="multipart/form-data"> <div class="mt-3"> <input type="text" name="newLibelleOther" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="number" step="0.01" name="newPriceOther" placeholder="Entrez la nouvelle valeur" class="form-control"> </div> <div class="mt-3"> <input type="file" name="newJustifOther" id="newJustifOther" class="form-control"> </div> <div class="mt-3"> <input type="submit" name ="submitUpdateFrais" value ="Modifier" class="btn btn-primary"> </div><input type="text" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display: none;""><input type="text" name="idFrais" value="'.$value['id'].'" style="display: none;""> <input type="text" name="actualLibelle" value="'.$value['libelle'].'" style="display: none;""> <input type="text" name="actualTiming" value="'.$value['timing'].'" style="display: none;""> <input type="text" name="actualMontant" value="'.$value['montant'].'" style="display: none;""><input type="text" name="actualLinkJustif" value="'.$value['linkJustif'].'" style="display: none;""></form> </div>' ;
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
                $isModifyButton = '<form action="preciseFrais.php" method="post"><input type="number" name="idFrais" value="'.$value['id'].'" style="display : none"><input name="libelleFrais" type="text" value="'.$value['libelle'].'" style="display : none"><input type="submit" name ="updateFrais" value ="Modifier" class="btn btn-primary"></form>';
            }
            else{
                $isModifyButton = '';
            }
            if($value['statue'] == 'NT'){
                $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-7" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M12 12l-2 3"></path><path d="M12 7v5"></path></svg>';
                //si le frais est forfaitaire
                if($value['statu'] == "F"){
                    if($value['linkJustif'] != ''){
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].'</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td><td>'.$isModifyButton.'</td></tr>';
                    }
                    else{
                        if($value['libelle'] == "transport (voiture)"){
                            echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].' km</td><td>'.$value['montant'].' €</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td>-</td><td>'.$isModifyButton.'</td></tr>';
                        }
                        else if($value['libelle'] == "logement"){
                            echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].' nuits</td><td>'.$value['montant'].' €</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td>-</td><td>'.$isModifyButton.'</td></tr>';
                        }
                        else if($value['libelle'] == "restauration"){
                            echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].' repas</td><td>'.$value['montant'].' €</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td>-</td><td>'.$isModifyButton.'</td></tr>';
                        }
                        else{
                            echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].' €</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td>-</td><td>'.$isModifyButton.'</td></tr>';
                        }
                    }
                }
                else{
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].' €</td><td>'.$value['dateligne'].'</td><td>Hors Forfait</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td><td>'.$isModifyButton.'</td></tr>';
                }
            }
            else{
                if($value['statu'] == "F"){
                    if($value['linkJustif'] != ''){
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].' €</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td></tr>';
                    }
                    else{
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].' €</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td>-</td></tr>';
                    }
                }
                else{
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].' €</td><td>'.$value['dateligne'].'</td><td>Hors Forfait</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td></tr>';
                }
            }
        }
        echo "<p class='mb-3'>Montant total : ".$montantTotal." €</p>";
        echo "<p class='mb-3'>Etat de la fiche frais : ".$icon." En attente</p>";      
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
        $CVCarUser = $request->getCvCarUser($db)['cvcar'];
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

        return $cost;
    }
}