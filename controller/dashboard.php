<?php
session_start();

$valueDeco = "";

// vérification de la provenance de l'utilisateur
if(isset($_SESSION['name'])){

    // destrcution de la variable erreur message
    if(isset($_SESSION['error_msg'])){
        unset($_SESSION['error_msg']);
    }
    $valueDeco = 'Déconnexion';
    $title = "Bonjour " .   $_SESSION['name'];
    if($_SESSION['statut'] == 0){
        include('../vue/pageVisiteur.php');
    }
    else{
        include('../vue/pageComptable.php');
    }
}
else{
    $title = "Veuillez vous connecter pour accéder à votre dashboard";
    $valueDeco = 'Se connecter';
    include('../vue/pageErreur.php');
};


?>

