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
    <form action="../controller/horsForfait.php">
        <h2>Hors forfait</h2>
        <input type="text" name ="libelle" placeholder ="libelle" required>
        <input type="number" name ="montant" placeholder ="montant" required>
        <input type="submit" name ="submit" placeholder ="valider">
    </form>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>