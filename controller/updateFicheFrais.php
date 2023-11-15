<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');
include('../controller/tools.php');

if(isset($_SESSION['name'])){
    if(isset($_POST['submitUpdateFrais'])){
        $idFicheFrais = $_POST['idFicheFrais'];
        $_SESSION['idFicheFrais'] = $idFicheFrais;

        if(isset($_POST['newKmCar']) || isset($_FILES['newTrainJustif']) || isset($_POST['newTrainMontant']) || isset($_POST['newNuitsLogement']) || isset($_POST['newPriceLogement']) || isset($_POST['newRepasRestauration']) || isset($_POST['newPriceRestauration']) || isset($_POST['newPriceOther']) || isset($_POST['newLibelleOther']) || isset($_FILES['newJustifOther'])){
            $idFrais = $_POST['idFrais'];
            $actualLibelle = $_POST['actualLibelle'];
            $actualTiming = $_POST['actualTiming'];
            $actualMontant = $_POST['actualMontant'];
            $actualLinkJustif = $_POST['actualLinkJustif'];
            $request = new request();

            if(isset($_POST['newKmCar'])){
                if(!empty($_POST['newKmCar'])){
                    $tools = new tools();
                    $cost = $tools->calculPriceCar($db, $_POST['newKmCar']);
                    $request->updateFrais($db, $actualLibelle, $cost, $_POST['newKmCar'], $actualLinkJustif, $idFrais);
                }
                header('Location: detailFicheFrais.php');
            }

            else if(isset($_FILES['newTrainJustif'])  && isset($_POST['newTrainMontant'])){
                $newTrainMontant = $_POST['newTrainMontant'];
                if(!empty($_POST['newTrainMontant']) || $_FILES['newTrainJustif']["error"] == 0){
                    if(!empty($_POST['newTrainMontant']) && $_FILES['newTrainJustif']["error"] == 0){
                        $tools = new tools();
                        $request->updateFrais($db, $actualLibelle, $newTrainMontant, $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newTrainJustif'), $idFrais);
                    }
                    else{
                        if($_FILES['newTrainJustif']["error"] == 0){
                            $tools = new tools();
                            $request->updateFrais($db, $actualLibelle, $actualMontant, $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newTrainJustif'), $idFrais);
                        }
                        else{
                            $request->updateFrais($db, $actualLibelle, $newTrainMontant, $actualTiming, $actualLinkJustif, $idFrais);
                        }
                    }
                    header('Location: detailFicheFrais.php');
                }
                else{
                    header('Location: detailFicheFrais.php');
                }
            }

            else if (isset($_POST['newNuitsLogement']) && isset($_POST['newPriceLogement'])){
                $newNuitsLogement = $_POST['newNuitsLogement'];
                $newPriceLogement = $_POST['newPriceLogement'];
                if(!empty($_POST['newNuitsLogement']) || !empty($_POST['newPriceLogement'])){
                    if(!empty($_POST['newNuitsLogement']) && !empty($_POST['newPriceLogement'])){
                        
                        $request->updateFrais($db, $actualLibelle, $newPriceLogement, $newNuitsLogement, $actualLinkJustif, $idFrais);
                    }
                    else{
                        if(!empty($_POST['newNuitsLogement'])){
                            $request->updateFrais($db, $actualLibelle, $actualMontant, $newNuitsLogement, $actualLinkJustif, $idFrais);
                        }
                        else{
                            $request->updateFrais($db, $actualLibelle, $newPriceLogement, $actualTiming, $actualLinkJustif, $idFrais);
                        }
                    } 
                    header('Location: detailFicheFrais.php');
                }
                else{
                    header('Location: detailFicheFrais.php');
                }
            }

            else if (isset($_POST['newRepasRestauration']) && isset($_POST['newPriceRestauration'])){
                $newRepasRestauration = $_POST['newRepasRestauration'];
                $newPriceRestauration = $_POST['newPriceRestauration'];
                if(!empty($_POST['newRepasRestauration']) || !empty($_POST['newPriceRestauration'])){
                    if(!empty($_POST['newRepasRestauration']) && !empty($_POST['newPriceRestauration'])){
                        
                        $request->updateFrais($db, $actualLibelle, $newPriceRestauration, $newRepasRestauration, $actualLinkJustif, $idFrais);
                    }
                    else{
                        if(!empty($_POST['newRepasRestauration'])){
                            $request->updateFrais($db, $actualLibelle, $actualMontant, $newRepasRestauration, $actualLinkJustif, $idFrais);
                        }
                        else{
                            $request->updateFrais($db, $actualLibelle, $newPriceRestauration, $actualTiming, $actualLinkJustif, $idFrais);
                        }
                    } 
                    header('Location: detailFicheFrais.php');
                }
                else{
                    header('Location: detailFicheFrais.php');
                }
            }

            else if (isset($_POST['newLibelleOther']) && isset($_POST['newPriceOther']) && isset($_FILES['newJustifOther'])){
                $newLibelleOther = $_POST['newLibelleOther'];
                $newPriceOther = $_POST['newPriceOther'];
                if(!empty($_POST['newLibelleOther']) || !empty($_POST['newPriceOther']) || $_FILES['newJustifOther']["error"] == 0){
                    if(!empty($_POST['newLibelleOther']) && !empty($_POST['newPriceOther']) && $_FILES['newJustifOther']["error"] == 0){
                        $tools = new tools();
                        $request->updateFrais($db, $newLibelleOther, $newPriceOther, $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newJustifOther'), $idFrais);
                    }
                    else{
                        $tools = new tools();
                        if(!empty($_POST['newLibelleOther']) && !empty($_POST['newPriceOther'])){
                            $request->updateFrais($db, $newLibelleOther, $newPriceOther, $actualTiming, $actualLinkJustif, $idFrais);
                        }
                        else if(!empty($_POST['newLibelleOther']) && $_FILES['newJustifOther']["error"] == 0){
                            $request->updateFrais($db, $newLibelleOther, $actualMontant, $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newJustifOther'), $idFrais);
                        }
                        else if(!empty($_POST['newPriceOther']) && $_FILES['newJustifOther']["error"] == 0){
                            $request->updateFrais($db, $actualLibelle, $newPriceOther, $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newJustifOther'), $idFrais);
                        }
                        else if(!empty($_POST['newLibelleOther'])){
                            $request->updateFrais($db, $newLibelleOther, $actualMontant, $actualTiming, $actualLinkJustif, $idFrais);
                        }
                        else if(!empty($_POST['newPriceOther'])){
                            $request->updateFrais($db, $actualLibelle, $newPriceOther, $actualTiming, $actualLinkJustif, $idFrais);
                        }
                        else if ($_FILES['newJustifOther']["error"] == 0){
                            $request->updateFrais($db, $actualLibelle, $actualMontant, $actualTiming, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newJustifOther'), $idFrais);
                        }
                    } 
                    header('Location: detailFicheFrais.php');
                }
                else{
                    header('Location: detailFicheFrais.php');
                }
            }

            $request->updatePriceCostSheet($db, $idFicheFrais);
        }
        else{
            header('Location: detailFicheFrais.php');
        }
    }
    else{
        header('Location: detailFicheFrais.php');
    }
}
else{
    header('Location: dashboard.php');
}
