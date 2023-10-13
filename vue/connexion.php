<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php')?>
</head>
<body>
    <nav>
        <h1>Connexion</h1>
    </nav>
    
    <main>
        <form action="../controller/login.php" method="post" class="loginForm">
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