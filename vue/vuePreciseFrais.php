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
            $result = $request->getPreciseCost($db, $idFrais);
        ?>
        <h2>Modifier le frais </h2>
        <form action="../controller/updateFicheFrais.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="">Libelle :</label>
                <input type="text" value="<?php echo $result['libelle'] ?>" name ="newLibelle" class="form-control p-2" <?php  echo ($result['statu'] == "HF" && $result['libelle'] != "transport (train)" ? "" : "disabled")?>>
            </div>
            <div class="mb-3">
                <label for="">Prix :</label>
                <input type="text" value="<?php echo $result['montant'] ?>" name ="newMontant" class="form-control p-2" <?php  echo ($result['libelle'] != "transport (voiture)" ? "" : "disabled")?>>
            </div>
            <div class="mb-3">
                <label for="">Distance / Durée :</label>
                <input type="text" value="<?php echo $result['timing'] ?>" name ="newTiming" class="form-control p-2" <?php  echo ($result['statu'] != "HF" ? "" : "disabled")?>>
            </div>
            <input type="text" name="idFrais" value="<?php echo $idFrais?>" style="display: none">
            <div class="mb-3">
                <label for="">Justificatif :</label>
                <input type="file" name="newJustif" id="newJustif" class="form-control" <?php  echo ($result['statu'] == "HF" ? "" : "disabled")?>>
                <img src="<?php echo $result['linkJustif'] ?>" alt=""  width="200px">
            </div>
            
            <div class="mb-3">
                <input type="submit" name ="submitUpdateFrais" value ="Modifier le frais" class="btn btn-primary">
            </div>
        </form>
    </span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>