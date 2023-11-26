<?php
session_start();
include('../model/functionSQL.php');
include('../model/config.php');
include('tools.php');

if(isset($_SESSION['error_msg_profile'])){
    unset($_SESSION['error_msg_profile']);
}
if(isset($_SESSION['err-desacValidation'])){
    unset($_SESSION['err-desacValidation']);
}

if(isset($_SESSION['name'])){
    if(isset($_POST['submitNewPP'])){
        if(isset($_FILES['newPP']) && $_FILES['newPP']['error'] == 0){
            $request = new request();
            $tools = new tools();
            $request->updatePP($db, $tools->downloadImage('../uploads/'.$_SESSION['idUser'].'/', 'newPP'), $_SESSION['idUser']);
            header('Location: profile.php');
        }
        else{
            $_SESSION['error_msg_profile'] = "Vous n'avez pas remplie le champs";
            header('Location: profile.php');
        }
    }
    else if (isset($_POST['desacValidation'])){
        if(isset($_SESSION['err-desacValidation'])){
            unset($_SESSION['err-desacValidation']);
        }
        if(!empty($_POST['goodWord']) && !empty($_POST['writeWord'])){
            if($_POST['goodWord'] == $_POST['writeWord']){
                $request = new request();
                $request->desactiveUser($db, $_SESSION['idUserModif']);
                $_SESSION['popupDesactiveUser'] = true;
                header('Location: dashboard.php');
            }
            else{
                $_SESSION['err-desacValidation'] = "Les mots renseignés ne sont pas identiques";
                header('Location: optionUser.php');
            }
        }
        else{
            $_SESSION['err-desacValidation'] = "Les champs n'ont pas été tous remplies";
            header('Location: optionUser.php');
        }
    }
    else if(isset($_POST['modifValidation'])){
        if(isset($_SESSION['err-modifValidation'])){
            unset($_SESSION['err-modifValidation']);
        }
        $request = new request();
        $result = $request->getComptableName($db, $_SESSION['idUserModif']); 
        foreach ($result as $key => $value) {
            if($value['name'] != $_POST['nameUser']){
                if(!empty($_POST['nameUser'])){
                    $request->updateProfile($db, $_SESSION['idUserModif'], 'name', $_POST['nameUser']);
                }
                else{
                    $_SESSION['err-modifValidation'] = "Un des champs est vide";
                    header('Location: optionUser.php');
                }
            }
            if($value['surname'] != $_POST['surnameUser']){
                if(!empty($_POST['surnameUser'])){
                    $request->updateProfile($db, $_SESSION['idUserModif'], 'surname', $_POST['surnameUser']);
                }
                else{
                    $_SESSION['err-modifValidation'] = "Un des champs est vide";
                    header('Location: optionUser.php');
                }
            }
            if($value['adress'] != $_POST['adressUser']){
                if(!empty($_POST['adressUser'])){
                    $request->updateProfile($db, $_SESSION['idUserModif'], 'adress', $_POST['adressUser']);
                }
                else{
                    $_SESSION['err-modifValidation'] = "Un des champs est vide";
                    header('Location: optionUser.php');
                }
            }
            if($value['cp'] != $_POST['cpUser']){
                if(!empty($_POST['cpUser'])){
                    $request->updateProfile($db, $_SESSION['idUserModif'], 'cp', $_POST['cpUser']);
                }
                else{
                    $_SESSION['err-modifValidation'] = "Un des champs est vide";
                    header('Location: optionUser.php');
                }
            }
            if($value['ville'] != $_POST['villeUser']){
                if(!empty($_POST['villeUser'])){
                    $request->updateProfile($db, $_SESSION['idUserModif'], 'ville', $_POST['villeUser']);
                }
                else{
                    $_SESSION['err-modifValidation'] = "Un des champs est vide";
                    header('Location: optionUser.php');
                }
            }
            if($value['cvcar'] != $_POST['cvCarUser']){
                if(!empty($_POST['cvCarUser'])){
                    $request->updateProfile($db, $_SESSION['idUserModif'], 'cvcar', $_POST['cvCarUser']);
                }
                else{
                    $_SESSION['err-modifValidation'] = "Un des champs est vide";
                    header('Location: optionUser.php');
                }
            }
        }
        $_SESSION['popupModifUserAdmin'] = true;
        header('Location: dashboard.php');
    }
    else{
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}