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
        <h2>Votre fiche Frais</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Libelle</th>
                    <th scope="col">Durée/Distance</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Montant Remboursé</th>
                    <th scope="col">Date</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Justificatifs</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include('../controller/tools.php');
                    $tools = new tools();
                    $tools->displayAllFraisVisiteur($db, $idFicheFrais) 
                ?>
            </tbody>
        </table>
        <?php
            if(isset($_SESSION['err-validate-frais'])){
                echo '<p class="err mb-3">'. $_SESSION['err-validate-frais'].'</p>';
            }
        ?>
        <div class="d-flex mb-3 justify-content-between gap-3 flex-wrap">
        <?php
        if($_SESSION['statut'] == "comptable"){
            $tools->displayValidationHF($db, $idFicheFrais);
        }
        ?>
        </div>
    </span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>