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
        <form action="../controller/changePassword.php" method="post" enctype="multipart/form-data">
            <h2>Changement de mot de passe</h2>

            <div class="mb-3">
                <input type="password" name ="password" placeholder ="Entrez le nouveau mot de passe" class="form-control p-2" required>
            </div>

            <div class="mb-3">
                <input type="password" name ="repassword" placeholder ="Confirmez le nouveau mot de passe" class="form-control p-2" required>
            </div>

            <div class="mb-3">
                <input type="submit" name ="submit" value ="Modifier" class="btn btn-primary">
            </div>

            <?php
                if(isset($_SESSION['error_msg_password'])){
                    echo '<p class="err mb-3">'. $_SESSION['error_msg_password'].'</p>';
                }
            ?>
        </form>
    </span>

</body>
<script src="../dist/viewDashboard.js"></script>
</html>