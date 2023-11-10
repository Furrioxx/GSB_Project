<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php')?> 
</head>
<body>
    <nav class="navbar-collapse">
        <?php include('../vue/UserNav.php') ?>
    </nav>

    <main>
        <h2><?php echo $title; ?></h2>
        <p>Visiteurs</p>
    </main>
    <div class ="container-fluid">
        <form action="../controller/horsForfait.php" method="post">
            <h2>Hors forfait</h2>
            <div class="mb-3">
                <input type="text" name ="libelle" placeholder ="libelle" required>
            </div>
            <div class="mb-3">
                <input type="number" step="0.01" name ="montant" placeholder ="montant" required>
            </div>
            <div class="mb-3">
                <input type="date" name="date" id="dateInput" required>
            </div>
            <input type="submit" name ="submit" placeholder ="valider" class="btn btn-primary">
        </form>
    </div>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>