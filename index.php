<?php
session_start();


// destrcution de la session après déconnexion
if(isset($_POST['deco'])){
    session_destroy();
    $hrefLogIn = "vue/connexion.php";
}
else{
    session_destroy();
    if(isset($_SESSION['name'])){
        $hrefLogIn = "controller/dashboard.php";
    }
    else{
        $hrefLogIn = "vue/connexion.php";
    }
}

include('vue/pageAcceuil.php');
?>

<!-- formulaire de connexion -->

