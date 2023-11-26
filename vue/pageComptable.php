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
        <h2><?php echo $title; ?></h2>
        <p class="mb-3">comptable</p>
        <a href="../controller/allFicheFrais.php">
            <button class="btn btn-secondary mb-3">Voir toute les fiches frais</button>
        </a>
        <h3>Fiche frais à traiter</h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date de début</th>
                    <th scope="col">Date de fin</th>
                    <th scope="col">Montant renseigné</th>
                    <th scope="col">Nom du visiteur</th>
                    <th scope="col">photo de profil</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../controller/tools.php');
                $ficheFrais = new tools();
                $ficheFrais->displayFicheFrais($db,'comptable', 'nt');
                ?>
            </tbody>
        </table>

        <?php
        if(isset($_SESSION['popUpValidateFrais'])){
            echo '<div class="toast " data-delay="5000" style="position: absolute; top: 126px; right: 0; width: 350px;"> <div class="toast-header bg-success"> <strong class="mr-auto  text-white">Validation réussis</strong></div><div style="--bs-bg-opacity: .5;" class="toast-body bg-success text-white"> Vous avez validé une fiche frais avec succès </div> </div>';
            unset($_SESSION['popUpValidateFrais']);
        }
        ?>
    </span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>