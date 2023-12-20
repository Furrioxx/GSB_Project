<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');
include('../controller/tools.php');

if(isset($_SESSION['name'])){
    if(isset($_POST['submitUpdateFrais'])){
        // if(isset($_POST['newKmCar']) || isset($_FILES['newTrainJustif']) || isset($_POST['newTrainMontant']) || isset($_POST['newNuitsLogement']) || isset($_POST['newPriceLogement']) || isset($_POST['newRepasRestauration']) || isset($_POST['newPriceRestauration']) || isset($_POST['newPriceOther']) || isset($_POST['newLibelleOther']) || isset($_FILES['newJustifOther'])){
        //     $idFrais = $_POST['idFrais'];
        //     $request = new request();
        //     $result = $request->getPreciseCost($db, $idFrais);

        //     $actualLibelle = $result['libelle'];
        //     $actualTiming = $result['timing'];
        //     $actualMontant = $result['montant'];
        //     $actualLinkJustif = $result['linkJustif'];
        //     $idFicheFrais = $result['idFicheFrais'];
        //     $_SESSION['idFicheFrais'] = $idFicheFrais;

        //     if(isset($_POST['newKmCar'])){
        //         if(!empty($_POST['newKmCar'])){
        //             $tools = new tools();
        //             $cost = $tools->calculPriceCar($db, $_POST['newKmCar']);
        //             $request->updateFrais($db, $actualLibelle, $cost, $_POST['newKmCar'], $actualLinkJustif, $idFrais);
        //         }
        //         $_SESSION['popUpModifFrais'] = true;
        //         header('Location: detailFicheFrais.php');
        //     }

        //     else if(isset($_FILES['newTrainJustif'])  && isset($_POST['newTrainMontant'])){
        //         $newTrainMontant = $_POST['newTrainMontant'];
        //         if(!empty($_POST['newTrainMontant']) || $_FILES['newTrainJustif']["error"] == 0){
        //             if(!empty($_POST['newTrainMontant']) && $_FILES['newTrainJustif']["error"] == 0){
        //                 $tools = new tools();
        //                 $request->updateFrais($db, $actualLibelle, $newTrainMontant, $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newTrainJustif'), $idFrais);
        //             }
        //             else{
        //                 if($_FILES['newTrainJustif']["error"] == 0){
        //                     $tools = new tools();
        //                     $request->updateFrais($db, $actualLibelle, $actualMontant, $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newTrainJustif'), $idFrais);
        //                 }
        //                 else{
        //                     $request->updateFrais($db, $actualLibelle, $newTrainMontant, $actualTiming, $actualLinkJustif, $idFrais);
        //                 }
        //             }
        //             $_SESSION['popUpModifFrais'] = true;
        //             header('Location: detailFicheFrais.php');
        //         }
        //         else{
        //             header('Location: detailFicheFrais.php');
        //         }
        //     }

        //     else if (isset($_POST['newNuitsLogement']) && isset($_POST['newPriceLogement'])){
        //         $newNuitsLogement = $_POST['newNuitsLogement'];
        //         $newPriceLogement = $_POST['newPriceLogement'];
        //         if(!empty($_POST['newNuitsLogement']) || !empty($_POST['newPriceLogement'])){
        //             if(!empty($_POST['newNuitsLogement']) && !empty($_POST['newPriceLogement'])){
                        
        //                 $request->updateFrais($db, $actualLibelle, $newPriceLogement, $newNuitsLogement, $actualLinkJustif, $idFrais);
        //             }
        //             else{
        //                 if(!empty($_POST['newNuitsLogement'])){
        //                     $request->updateFrais($db, $actualLibelle, $actualMontant, $newNuitsLogement, $actualLinkJustif, $idFrais);
        //                 }
        //                 else{
        //                     $request->updateFrais($db, $actualLibelle, $newPriceLogement, $actualTiming, $actualLinkJustif, $idFrais);
        //                 }
        //             }
        //             $_SESSION['popUpModifFrais'] = true; 
        //             header('Location: detailFicheFrais.php');
        //         }
        //         else{
        //             header('Location: detailFicheFrais.php');
        //         }
        //     }

        //     else if (isset($_POST['newRepasRestauration']) && isset($_POST['newPriceRestauration'])){
        //         $newRepasRestauration = $_POST['newRepasRestauration'];
        //         $newPriceRestauration = $_POST['newPriceRestauration'];
        //         if(!empty($_POST['newRepasRestauration']) || !empty($_POST['newPriceRestauration'])){
        //             if(!empty($_POST['newRepasRestauration']) && !empty($_POST['newPriceRestauration'])){
                        
        //                 $request->updateFrais($db, $actualLibelle, $newPriceRestauration, $newRepasRestauration, $actualLinkJustif, $idFrais);
        //             }
        //             else{
        //                 if(!empty($_POST['newRepasRestauration'])){
        //                     $request->updateFrais($db, $actualLibelle, $actualMontant, $newRepasRestauration, $actualLinkJustif, $idFrais);
        //                 }
        //                 else{
        //                     $request->updateFrais($db, $actualLibelle, $newPriceRestauration, $actualTiming, $actualLinkJustif, $idFrais);
        //                 }
        //             } 
        //             $_SESSION['popUpModifFrais'] = true;
        //             header('Location: detailFicheFrais.php');
        //         }
        //         else{
        //             header('Location: detailFicheFrais.php');
        //         }
        //     }

        //     else if (isset($_POST['newLibelleOther']) && isset($_POST['newPriceOther']) && isset($_FILES['newJustifOther'])){
        //         $newLibelleOther = $_POST['newLibelleOther'];
        //         $newPriceOther = $_POST['newPriceOther'];
        //         if(!empty($_POST['newLibelleOther']) || !empty($_POST['newPriceOther']) || $_FILES['newJustifOther']["error"] == 0){
        //             if(!empty($_POST['newLibelleOther']) && !empty($_POST['newPriceOther']) && $_FILES['newJustifOther']["error"] == 0){
        //                 $tools = new tools();
        //                 $request->updateFrais($db, $newLibelleOther, $newPriceOther, $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newJustifOther'), $idFrais);
        //             }
        //             else{
        //                 $tools = new tools();
        //                 if(!empty($_POST['newLibelleOther']) && !empty($_POST['newPriceOther'])){
        //                     $request->updateFrais($db, $newLibelleOther, $newPriceOther, $actualTiming, $actualLinkJustif, $idFrais);
        //                 }
        //                 else if(!empty($_POST['newLibelleOther']) && $_FILES['newJustifOther']["error"] == 0){
        //                     $request->updateFrais($db, $newLibelleOther, $actualMontant, $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newJustifOther'), $idFrais);
        //                 }
        //                 else if(!empty($_POST['newPriceOther']) && $_FILES['newJustifOther']["error"] == 0){
        //                     $request->updateFrais($db, $actualLibelle, $newPriceOther, $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newJustifOther'), $idFrais);
        //                 }
        //                 else if(!empty($_POST['newLibelleOther'])){
        //                     $request->updateFrais($db, $newLibelleOther, $actualMontant, $actualTiming, $actualLinkJustif, $idFrais);
        //                 }
        //                 else if(!empty($_POST['newPriceOther'])){
        //                     $request->updateFrais($db, $actualLibelle, $newPriceOther, $actualTiming, $actualLinkJustif, $idFrais);
        //                 }
        //                 else if ($_FILES['newJustifOther']["error"] == 0){
        //                     $request->updateFrais($db, $actualLibelle, $actualMontant, $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newJustifOther'), $idFrais);
        //                 }
        //             } 
        //             $_SESSION['popUpModifFrais'] = true;
        //             header('Location: detailFicheFrais.php');
        //         }
        //         else{
        //             header('Location: detailFicheFrais.php');
        //         }
        //     }

        //     $request->updatePriceCostSheet($db, $idFicheFrais);
        // }
        if(isset($_POST['newLibelle']) || isset($_POST['newMontant']) || isset($_POST['newTiming']) || isset($_FILES['newJustif'])){
            $idFrais = $_POST['idFrais'];
            $request = new request();
            $result = $request->getPreciseCost($db, $idFrais);

            $actualLibelle = $result['libelle'];
            $actualTiming = $result['timing'];
            $actualMontant = $result['montant'];
            $actualLinkJustif = $result['linkJustif'];
            $idFicheFrais = $result['idFicheFrais'];
            $_SESSION['idFicheFrais'] = $idFicheFrais; 

            //pour HF
            if(isset($_POST['newLibelle']) && isset($_POST['newMontant']) && isset($_FILES['newJustif'])){
                if(!empty($_POST['newMontant']) && !empty($_POST['newLibelle'] && $_FILES['newJustif']["error"] == 0)){
                    $tools = new tools();
                    $request->updateFrais($db, $_POST['newLibelle'], $_POST['newMontant'], $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newJustif'), $idFrais);
                }
                else if(!empty($_POST['newMontant']) && !empty($_POST['newLibelle'])){
                    $request->updateFrais($db, $_POST['newLibelle'], $_POST['newMontant'], $actualTiming, $actualLinkJustif, $idFrais);
                }
            }
            //pour train
            else if(isset($_POST['newMontant']) && isset($_FILES['newJustif'])){
                if(!empty($_POST['newMontant']) && $_FILES['newJustif']["error"] == 0){
                    $tools = new tools();
                    $request->updateFrais($db, $actualLibelle, $_POST['newMontant'], $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newJustif'), $idFrais);
                }
                else if(!empty($_POST['newMontant'])){
                    $request->updateFrais($db, $actualLibelle, $_POST['newMontant'], $actualTiming, $actualLinkJustif, $idFrais);
                }
            }
            //pour restauration / dodo
            else if(isset($_POST['newMontant']) && isset($_POST['newTiming'])){
                if(!empty($_POST['newMontant']) && !empty($_POST['newTiming'])){
                    $request->updateFrais($db, $actualLibelle, $_POST['newMontant'], $_POST['newTiming'], $actualLinkJustif, $idFrais);
                }
            }
            //pour la voiture
            else if(isset($_POST['newTiming'])){
                if(!empty($_POST['newTiming'])){
                    $tools = new tools();
                    $cost = $tools->calculPriceCar($db, $_POST['newTiming']);
                    $request->updateFrais($db, $actualLibelle, $cost, $_POST['newTiming'], $actualLinkJustif, $idFrais);
                }
            }
            else{
                echo 'caac';
            }
            $_SESSION['popUpModifFrais'] = true;
            header('Location: detailFicheFrais.php');
            $request->updatePriceCostSheet($db, $idFicheFrais);
        }
        else{
            header('Location: detailFicheFrais.php');
        }
    }
    else{
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}
