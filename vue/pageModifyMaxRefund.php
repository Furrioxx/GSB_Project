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
        <h2>Modifier le remboursement maximum</h2>
        <form action="../controller/updateMaxRefund.php" method="post">
            <div class="mb-3">
                <label for="">Logement :</label>
                <input type="text" value="<?php echo $maxPrice1night ?>" name ="maxPrice1night" class="form-control p-2">
            </div>
            <div class="mb-3">
                <label for="">Restauration :</label>
                <input type="text" value="<?php echo $maxPrice1Meal ?>" name ="maxPrice1Meal" class="form-control p-2">
            </div>

            <div class="mb-3">
                <input type="submit" name ="submitModifMaxRefund" value ="Modifier les prix" class="btn btn-primary">
            </div>

            <?php
                if(isset($_SESSION['err-modifMaxRefund'])){
                    echo '<p class="err mb-3">'. $_SESSION['err-modifMaxRefund'].'</p>';
                }
            ?>
        </form>
    </span>
</body>
</html>