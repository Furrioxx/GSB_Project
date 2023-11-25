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
        <?php 
            $request = new request();
            $result = $request->getComptableName($db, $_SESSION['idUserModif']);      
        ?>
        <h2>Modifier le profile de <?php echo $result[0]['name'] . " " . $result[0]['surname'] . " (" . $result[0]['statut'] . ")"; ?></h2>
        <form action="../controller/updateProfile.php" method="post">
            <div class="mb-3">
                <label for="">Prenom :</label>
                <input type="text" value="<?php echo $result[0]['name'] ?>" name ="nameUser" class="form-control p-2">
            </div>
            <div class="mb-3">
                <label for="">Nom :</label>
                <input type="text" value="<?php echo $result[0]['surname'] ?>" name ="surnameUser" class="form-control p-2">
            </div>
            <div class="mb-3">
                <label for="">Adresse :</label>
                <input type="text" value="<?php echo $result[0]['adress'] ?>" name ="adressUser" class="form-control p-2">
            </div>
            <div class="mb-3">
                <label for="">Code postal :</label>
                <input type="number" value="<?php echo $result[0]['cp'] ?>" name ="cpUser" class="form-control p-2">
            </div>
            <div class="mb-3">
                <label for="">Ville :</label>
                <input type="text" value="<?php echo $result[0]['ville'] ?>" name ="villeUser" class="form-control p-2">
            </div>
            <div class="mb-3">
                <label for="">Chevaux de la voiture :</label>
                <input type="text" value="<?php echo $result[0]['cvcar'] ?>" name ="cvCarUser" class="form-control p-2">
            </div>
            <div class="mb-3">
                <input type="submit" name ="modifValidation" value ="Modifier le compte" class="btn btn-primary">
            </div>

            <?php
                if(isset($_SESSION['err-modifValidation'])){
                    echo '<p class="err mb-3">'. $_SESSION['err-modifValidation'].'</p>';
                }
            ?>
        </form>
    </span>
</body>
</html>