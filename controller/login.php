<?php
session_start();
include('../model/functionSQL.php');
include('../model/config.php');

if(isset($_POST['submit'])){
    // vérification que les champs sont bien remplis
    if(!empty($_POST['mail']) && !empty($_POST['password'])){
        $fucntionSQL = new request();
        $result = $fucntionSQL->getUser($db, $_POST['mail']);
        if(!empty($result)){
            foreach ($result as $key => $value) {
                if(strlen($_POST['password']) > 8){
                    if(password_verify($_POST['password'], $value['password'])){
                        $_SESSION['name'] = $value['name'];
                        $_SESSION['idUser'] = $value['id'];
                        $_SESSION['statut'] = $value['statut'];
                        $_SESSION['surname'] = $value['surname'];
                        $_SESSION['isActive'] = $value['isActive'];
                        header("Location: dashboard.php");
                    }
                    else{
                        $_SESSION['error_msg'] = "L'indentifiant ou le mot de passe est incorrect !!";
                        header('Location: ../vue/connexion.php');
                    }
                }
                else{
                    if(password_verify($_POST['password'], $value['password'])){
                        $_SESSION['name'] = $value['name'];
                        $_SESSION['idUser'] = $value['id'];
                        $_SESSION['statut'] = $value['statut'];
                        $_SESSION['surname'] = $value['surname'];
                        $_SESSION['isFirstConnexion'] = true;
                        header("Location: dashboard.php");
                    }
                    else{
                        $_SESSION['error_msg'] = "L'indentifiant ou le mot de passe est incorrect !!";
                        header('Location: ../vue/connexion.php');
                    }
                }
            }
        }
        else{
            $_SESSION['error_msg'] = "L'indentifiant ou le mot de passe est incorrect !!";
            header('Location: ../vue/connexion.php');
        }
    }
    else{
        $_SESSION['error_msg'] = "Les champs n'ont pas tous été remplie";
        header('Location: ../vue/connexion.php'); 
    }

}
else{
    header('Location: ../vue/connexion.php');
}
?>