<?php
session_start();


// destrcution de la session après déconnexion
if(isset($_GET['deco'])){
    session_destroy();
    $hrefLogIn = "vue/connexion.php";
}
else{
    if(isset($_SESSION['name'])){
        $hrefLogIn = "controller/dashboard.php";
    }
    else{
        $hrefLogIn = "vue/connexion.php";
    }
}


include('vue/pageAcceuil.php')
?>

<!-- formulaire de connexion -->

