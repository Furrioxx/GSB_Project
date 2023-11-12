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
    $title = "Veuillez vous connecter pour accéder à votre dashboard";
    $valueDeco = 'Se connecter';
    include('../vue/pageErreur.php');
};


?>

