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



include('vue/pageAcceuil.php');
echo date("Y-m-d");
echo substr(date("Y-m-d"),0,-3);
?>

<!-- formulaire de connexion -->

