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
            if(isset($_SESSION['popUpModifFrais'])){
                echo '<div class="toast " data-delay="5000" style="position: absolute; top: 126px; right: 0; width: 350px;"> <div class="toast-header bg-success"> <strong class="mr-auto  text-white">Modification réussis</strong></div><div style="--bs-bg-opacity: .5;" class="toast-body bg-success text-white"> Vous avez modifié un frais avec succès </div> </div>';
                unset($_SESSION['popUpModifFrais']);
            }
        ?>
        <div class="d-flex mb-3 justify-content-between gap-3 flex-wrap">
        <?php
        // si le role est comptable et si la fiche frais est non traité
        if($_SESSION['statut'] == "comptable" && $tools->isCostSheetNotTraite($db, $idFicheFrais)){
            $tools->displayValidationHF($db, $idFicheFrais, $maxRefund1night, $maxRefund1meal);
        }
        ?>
        </div>
    </span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>