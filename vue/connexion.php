<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php')?>
</head>
<body>
    <nav class="navbar-collapse">
        <h1>Connexion</h1>
    </nav>
    
    <main>
        <div class ="container mb-3">
            <form action="../controller/login.php" method="post" class="loginForm">
                <input type="mail" placeholder="Mail" name="mail" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="submit" value="Login" name="submit" class="btn btn-primary">
                <?php

                // affichage du message d'erreur si mauvais identifiants
                if(isset($_SESSION['error_msg'])){
                    echo '<p class="err">'. $_SESSION['error_msg'].'</p>';
                }
                ?>
            </form>
        </div>
    </main>

</body>
<?php 
include('footer.php');
?>
</html>