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
        <main>
            <h2><?php echo $title; ?></h2>
            <p>Visiteurs</p>
        </main>
        <form action="../controller/fraisUser.php" method="post">
            <h2>Frais Forfait</h2>
            <h3>Transport</h3>
            <div class="mb-3">
                <input type="text" placeholder="Entrez l'immatriculation de votre voiture" name="imatTransport" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="number" placeholder="Entrez le nombre de kilomètre parcouru" step="0.1" name="kmTransport" class="form-control">
            </div>
            <div class="mb-3">
                <input type="date" name="dateTransport" class="form-control" >
            </div>
            <h3>Hébergement</h3>
            <div class="mb-3">
                <input type="text" placeholder="Nom de l'établissement" name="NameLogement" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="number" step="0.01" placeholder="Montant de l'hébergement" name="priceLogement" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="date" name="dateLogement" class="form-control" >
            </div>
            <h3>Alimentation</h3>
            <div class="mb-3">
                <input type="text" placeholder="Nom du restaurant" name="restaurantName" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="number" step="0.01" placeholder="Montant de l'addition" name="restaurantPrice" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="date" name="restaurantDate" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="submit" name="submitF" value="valider"  >
            </div>
        </form>
        <form action="../controller/fraisUser.php" method="post">
            <h2>Hors forfait</h2>
            <div class="mb-3">
                <input type="text" name ="libelle" placeholder ="libelle" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="number" step="0.01" name ="montant" placeholder ="montant" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="date" name="date" id="dateInput"class="form-control"  required>
            </div>
            <div class="mb-3">
                <input type="submit" name ="submitHF" value ="valider">
            </div>
        </form>

        <div class="viewFicheFrais">
            <h3>Fiche frais View</h3>

            <?php
            include('../controller/fraisUserView.php');
            ?>
        </div>
</span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>