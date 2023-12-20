<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');
include('../controller/tools.php');

if(isset($_SESSION['name'])){
    if(isset($_POST['submitUpdateFrais'])){
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
