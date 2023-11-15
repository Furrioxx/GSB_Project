<?php
session_start();
include('../model/functionSQL.php');
include('../model/config.php');
include('../controller/tools.php');

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
                            $tools = new tools();
                            $request->sendFrais($db,null,'transport (voiture)', $tools->calculPriceCar($db, $kmTransport), $kmTransport , $endDate, $idFicheFrais, 'F', null);
                        }
                    }
                    //si le transport est le train
                    else{
                        
                        if(!empty($transportMontant) && isset($_FILES['transportFile'])){
                            include('../controller/tools.php');
                            $fileDownload = new tools();
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
                        include('../controller/tools.php');
                        $fileDownload = new tools();
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