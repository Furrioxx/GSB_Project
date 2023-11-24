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
        <a href="../controller/dashboard.php" class="mb-3"><button class="btn btn-primary">Retour</button></a>
        <h2>Désactivation du compte de 
            <?php 
            $request = new request();
            $result = $request->getComptableName($db, $_SESSION['idUserModif']);
            echo $result[0]['name'] . " " . $result[0]['surname'];
            ?>
        </h2>
        <form action="../controller/updateProfile.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="text" name ="goodWord" id="goodWord" class="form-control p-2 " readonly>
            </div>

            <div class="mb-3">
                <input type="text" name ="writeWord" placeholder ="Ecrivez le mot ci-dessus" class="form-control p-2" required>
            </div>

            <div class="mb-3">
                <input type="number" value="<?php echo $_SESSION['idUserModif']; ?>" name ="idUser" class="form-control p-2" style="display:none">
            </div>

            <div class="mb-3">
                <input type="submit" name ="desacValidation" value ="Désactiver le compte" class="btn btn-primary">
            </div>

            <?php
                if(isset($_SESSION['err-desacValidation'])){
                    echo '<p class="err mb-3">'. $_SESSION['err-desacValidation'].'</p>';
                }
            ?>
        </form>
    </span>

</body>
<script src="../dist/desacPage.js"></script>
</html>