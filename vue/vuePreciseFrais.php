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
        <h2>Modifier le Frais</h2>

        <h5 class="mb-3"><?php echo $libelleFrais?></h5>

        <div class="d-flex mb-3 justify-content-between gap-3 flex-wrap">

            <?php
            include('../controller/tools.php');
            $updateFraisClass = new tools();
            $updateFraisClass->displayGoodForm($db,$idFrais);
            ?>

        </div>
    </span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>