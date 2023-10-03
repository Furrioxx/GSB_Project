<?php
session_start();
$mail = "test@gmail.com";
$pass = "azerty";


if(isset($_POST['submit'])){

    if($_POST['mail'] == $mail && $_POST['password'] == $pass){
        $_SESSION['mail'] = $_POST['mail'];
        header('Location: dashboard.php');
    }
    else{
        $_SESSION['error_msg'] = "<p class='err'>L'indentifiant ou le mot de passe est incorect !!</p>";
        header('Location: index.php');
    }

}
else{
    header('Location: index.php');
}
?>