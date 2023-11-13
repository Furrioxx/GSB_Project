<?php
session_start();
include('../model/functionSQL.php');
include('../model/config.php');

class fileDownload{
    public function __construct()
    {
        
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
}

if(isset($_SESSION['name'])){
    if(isset($_POST['submit'])){
        if(isset($_SESSION['error_msg_dashboard'])){
            unset($_SESSION['error_msg_dashboard']);
        }

        $beginDate = $_POST['beginDate'];
        $endDate = $_POST['endDate'];

        $kmTransport = $_POST['kmTransport'];
        if(isset($_POST['transportMontant'])){
            $transportMontant = $_POST['transportMontant'];
        }
        

        $TimeLogement = $_POST['TimeLogement'];
        $priceLogement = $_POST['priceLogement'];

        $restaurantTime = $_POST['restaurantTime'];
        $restaurantPrice = $_POST['restaurantPrice'];

        $libelleOther = $_POST['libelleOther'];
        $montantOther = $_POST['montantOther'];
        
        $request = new request;

        //si les dates sont remplies
        if(!empty($beginDate)|| !empty( $endDate)){
            //vérification de la validité des dates 
            if($beginDate <= $endDate){
            //si au moins 1 frais est remplie :
                if(!empty($kmTransport) || !empty($transportMontant) || !empty($TimeLogement) || !empty($priceLogement) || !empty($restaurantTime) || !empty($restaurantPrice) || !empty($libelleOther) || !empty($montantOther)){
                    //creer une fiche frais et return son id
                    $idFicheFrais = $request->createFicheFrais($db, $beginDate, $endDate);
                    if($_POST['transport'] == "car"){   
                        if(!empty($kmTransport)){
                            $CVCarUser = $request->getCvCarUser($db)['cvcar'];  
                            if($kmTransport <= 5000){
                                if($CVCarUser <= 3){
                                    $cost = 0.529*$kmTransport;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                                else if ($CVCarUser == 4){
                                    $cost = 0.606*$kmTransport;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                                else if ($CVCarUser == 5){
                                    $cost = 0.636*$kmTransport;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                                else if ($CVCarUser == 6){
                                    $cost = 0.665*$kmTransport;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                                else if ($CVCarUser >= 7){
                                    $cost = 0.697*$kmTransport;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                            }
                            else if($kmTransport > 5000 &&  $kmTransport <= 20000){
                                if($CVCarUser <= 3){
                                    $cost = 0.316*$kmTransport + 1061;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                                else if ($CVCarUser == 4){
                                    $cost = 0.340*$kmTransport + 1330;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                                else if ($CVCarUser == 5){
                                    $cost = 0.356*$kmTransport + 1391;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                                else if ($CVCarUser == 6){
                                    $cost = 0.374*$kmTransport + 1457;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                                else if ($CVCarUser >= 7){
                                    $cost = 0.394*$kmTransport + 1512;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                            }
                            else if($kmTransport > 20000){
                                if($CVCarUser <= 3){
                                    $cost = 0.369*$kmTransport;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                                else if ($CVCarUser == 4){
                                    $cost = 0.408*$kmTransport;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                                else if ($CVCarUser == 5){
                                    $cost = 0.427*$kmTransport;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                                else if ($CVCarUser == 6){
                                    $cost = 0.448*$kmTransport;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                                else if ($CVCarUser >= 7){
                                    $cost = 0.470*$kmTransport;
                                    $request->sendFrais($db,null,'transport (voiture)',$cost, $kmTransport , $endDate, $idFicheFrais, 'F', null);
                                }
                            }
                        }
                    }
                    //si le transport est le train
                    else{
                        
                        if(!empty($transportMontant) && isset($_FILES['transportFile'])){
                            $fileDownload = new fileDownload();
                            $request->sendFrais($db, null, 'transport (train)', $transportMontant, null, $endDate, $idFicheFrais, 'HF', $fileDownload->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'transportFile'));
                        }
                    }
                    //si les champs hebergement on été remplies
                    if(!empty($TimeLogement) && !empty($priceLogement)){
                        if($TimeLogement  != 0){
                            $request->sendFrais($db,null,'logement',$priceLogement, $TimeLogement , $endDate, $idFicheFrais, 'F', null);
                        }
                    }
                    //si les champs alimentations on été remplies
                    if(!empty($restaurantTime) && !empty($restaurantPrice)){
                        if($restaurantTime != 0){
                            $request->sendFrais($db,null,'restauration',$restaurantPrice, $restaurantTime , $endDate, $idFicheFrais, 'F', null);
                        }
                    }
                    //si le champs autre a été remplies
                    if(!empty($libelleOther) &&  !empty($montantOther) && isset($_FILES['fileOther'])){
                        $fileDownload = new fileDownload();
                        $request->sendFrais($db, null, $libelleOther, $montantOther, null, $endDate, $idFicheFrais, 'HF', $fileDownload->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'fileOther'));   
                    }
                    $request->updatePriceCostSheet($db, $idFicheFrais);
                }
                else{
                    //message erreur, aucun des champs ont été remplies (outre les dates)
                    $_SESSION['error_msg_dashboard'] = "Aucun champs n'a été remplie";
                }
            }
            else{
                //message erreur, les dates ne vont pas (debut supérieur a fin)
                $_SESSION['error_msg_dashboard'] = "Les dates ne sont pas valides";
            }
        }
        else{
            //message erreur, les dates n'ont  pas été indiqué
            $_SESSION['error_msg_dashboard'] = "Les dates n'ont pas été indiqué";
        }
        header('Location: dashboard.php');
    }
    else{
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}


?>