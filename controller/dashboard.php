<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');
$valueDeco = "";
// vérification de la provenance de l'utilisateur
if(isset($_SESSION['name'])){
    if(isset($_SESSION['isFirstConnexion'])){
        include('../vue/pageChangePassword.php');
    }
    else{
        if(isset($_SESSION['error_msg'])){
            unset($_SESSION['error_msg']);
        }
        if(isset( $_SESSION['idUserModif'])){
            unset( $_SESSION['idUserModif']);
        }
        if(isset($_SESSION['err-desacValidation'])){
            unset($_SESSION['err-desacValidation']);
        }
        if(isset($_SESSION['err-addUser'])){
            unset($_SESSION['err-addUser']);
        }
        $valueDeco = 'Déconnexion';
        $title = "Bonjour " .   $_SESSION['name'];
        if($_SESSION['isActive'] == 1){
            if($_SESSION['statut'] == 'visiteur'){
                include('../vue/pageVisiteur.php');
            }
            else if ($_SESSION['statut'] == 'comptable'){
                include('../vue/pageComptable.php');
            }
            else if($_SESSION['statut'] == 'admin'){
                include('../vue/pageAdmin.php');
            }
        }
        else{
            $title = "Votre compte à été désactivé";
            $valueDeco = 'Se connecter';
            include('../vue/pageDesactive.php');
        }
    }
    // destrcution de la variable erreur message
}
else{
    $title = "Veuillez vous connecter pour accéder à votre dashboard";
    $valueDeco = 'Se connecter';
    include('../vue/pageErreur.php');
}


?>

