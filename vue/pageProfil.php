<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php')?> 
</head>
<body>
    <nav class="navbar-collapse">
        <?php include('../vue/UserNav.php') ?>
    </nav>

    <span>
        <a href="../controller/dashboard.php" class="mb-3"><button class="btn btn-primary">Retour</button></a>
        <h2>Votre Profile</h2>
        <?php
        $tools = new tools();
        $tools->displayProfilePP($db);
        ?>
        <form action="updateProfile.php" method="post" enctype="multipart/form-data" class="formModifyPP">
            <div class="mb-3">
                <label for="newPP">Nouvelle photo de profil :</label>
                <input type="file" name ="newPP" id="newPP" class="form-control p-2" required>
            </div>

            <div class="mb-3">
                <input type="submit" name ="submit" value ="Modifier" class="btn btn-primary">
            </div>
        </form>
        <?php
        if(isset($_SESSION['error_msg_profile'])){
            echo '<p class="err mb-3">'. $_SESSION['error_msg_profile'].'</p>';
        }
        ?>
    </span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>