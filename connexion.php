<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="dist/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <h1>Connexion</h1>
    </nav>
    
    <main>
        <form action="login.php" method="post" class="loginForm">
            <input type="mail" placeholder="Mail" name="mail" required>
            <input type="password" placeholder="Password" name="password" required>
            <input type="submit" value="Login" name="submit">
            <?php

            // affichage du message d'erreur si mauvais identifiants
            if(isset($_SESSION['error_msg'])){
                echo '<p class="err">'. $_SESSION['error_msg'].'</p>';
            }

            ?>
        </form>
    </main>

</body>
</html>