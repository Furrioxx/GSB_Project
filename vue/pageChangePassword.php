<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php')?>
</head>
<body>
    <nav>
        <?php include('../vue/UserNav.php') ?>
    </nav>

    <span>
        <?php
        if(isset($_SESSION['newPass'])){
            echo '<a href="../controller/profile.php" class="mb-3"><button class="btn btn-primary">Retour</button></a>';
        }
        ?>
        <form action="../controller/changePassword.php" method="post" enctype="multipart/form-data" onsubmit="return verifPassOnSubmit()">
            <h2>Changement de mot de passe</h2>

            <div class="mb-3">
                <input type="password" name ="password" id="password" placeholder ="Entrez le nouveau mot de passe" class="form-control p-2" required>
            </div>

            <div class="mb-3">
                <input type="password" name ="repassword" placeholder ="Confirmez le nouveau mot de passe" class="form-control p-2" required>
            </div>

            <div class="mb-3 verifPass" >
                <ul>
                    <li class="minChars">Minimum 8 caractère</li>
                    <li class="majAndMin">Majuscule et minuscule</li>
                    <li class="min1Number">Minimum 1 chiffre</li>
                    <li class="minSpecialChars">Minimum une caractère spécial</li>
                </ul>
            </div>

            <div class="mb-3">
                <input type="submit" name ="submit" value ="Modifier" class="btn btn-primary">
            </div>
            <p class="err mb-3" id="sendErr"></p>
            <?php
                if(isset($_SESSION['error_msg_password'])){
                    echo '<p class="err mb-3">'. $_SESSION['error_msg_password'].'</p>';
                }
            ?>
        </form>
    </span>

</body>
<script src="../dist/viewDashboard.js"></script>
<script src="../dist/verifPass.js"></script>
</html>