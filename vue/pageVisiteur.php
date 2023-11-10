<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php')?> 
</head>
<body>
    <nav>
        <?php include('../vue/UserNav.php') ?>
    </nav>

    <main>
        <h2><?php echo $title; ?></h2>
        <p>Visiteurs</p>
    </main>
    <form action="../controller/fraisUser.php" method="post">
        <h2>Frais Forfait</h2>
        <h3>Transport</h3>
        <input type="text" placeholder="Entrez l'immatriculation de votre voiture" name="imatTransport">
        <input type="number" placeholder="Entrez le nombre de kilomètre parcouru" step="0.1" name="kmTransport">
        <input type="date" name="dateTransport">

        <h3>Hébergement</h3>
        <input type="text" placeholder="Nom de l'établissement" name="NameLogement">
        <input type="number" step="0.01" placeholder="Montant de l'hébergement" name="priceLogement">
        <input type="date" name="dateLogement">

        <h3>Alimentation</h3>
        <input type="text" placeholder="Nom du restaurant" name="restaurantName">
        <input type="number" step="0.01" placeholder="Montant de l'addition" name="restaurantPrice">

        <input type="submit" name="submitF" value="valider">
    
    </form>
    <form action="../controller/fraisUser.php" method="post">
        <h2>Hors forfait</h2>
        <input type="text" name ="libelle" placeholder ="libelle" required>
        <input type="number" step="0.01" name ="montant" placeholder ="montant" required>
        <input type="date" name="date" id="dateInput" required>
        <input type="submit" name ="submitHF" value ="valider">
    </form>

    <div class="viewFicheFrais">
        <h3>Fiche frais View</h3>

        <?php
        include('../controller/fraisUserView.php');
        ?>
    </div>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>