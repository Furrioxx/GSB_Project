<?php
session_start();


// destrcution de la session après déconnexion
if(isset($_POST['deco'])){
    session_destroy();
    $hrefLogIn = "vue/connexion.php";
}
else{
    if(isset($_SESSION['mail'])){
        $hrefLogIn = "vue/dashboard.php";
    }
    else{
        $hrefLogIn = "vue/connexion.php";
    }
}


include('vue/pageAcceuil.php')
?>

<!-- formulaire de connexion -->

