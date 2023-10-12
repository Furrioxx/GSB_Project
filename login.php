<?php
session_start();

include('config.php');


if(isset($_POST['submit'])){
    // vérification que les champs sont bien remplis
    if(!empty($_POST['mail']) && !empty($_POST['password'])){
        //vérification du mail et mdp
        $sql1 = "SELECT * FROM visiteurs WHERE login = '".$_POST['mail']."'";
            $result = $db->prepare($sql1);
            $result->execute(); 
            $resultTab = $result->fetchAll();
            if(!empty($resultTab)){
                foreach ($resultTab as $key => $value) {
                    if(password_verify($_POST['password'], $value['password'])){
                        $_SESSION['pseudo'] = $value['name'];
                        echo"trouvé";
                        header("Location: dashboard.php");
                    }
                    else{
                        $_SESSION['error_msg'] = "<p class='err'>L'indentifiant ou le mot de passe est incorrect !!</p>";
                        header('Location: connexion.php');
                    }
                }
            }
            else{
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