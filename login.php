<?php
session_start();
$mail = "test@gmail.com";
$pass = "azerty";


if(isset($_POST['submit'])){

    // vérification que les champs sont bien remplis
    if(!empty($_POST['mail']) && !empty($_POST['password'])){
        //vérification du mail et mdp
        if($_POST['mail'] == $mail && $_POST['password'] == $pass){
            //creation variable de session
            $_SESSION['mail'] = $_POST['mail'];
            header('Location: dashboard.php');
        }
        else{
            // création de variable erreur si identifiants incorrect 
            $_SESSION['error_msg'] = "<p class='err'>L'indentifiant ou le mot de passe est incorrect !!</p>";
            header('Location: connexion.php');
        }
    }
    else{
        $_SESSION['error_msg'] = "<p class='err'>Les champs n'ont pas tous été remplie</p>";
        header('Location: connexion.php'); 
    }

}
else{
    header('Location: connexion.php');
}
?>