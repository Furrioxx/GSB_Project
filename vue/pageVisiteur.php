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
        <h2><?php echo $title; ?></h2>
        <p class="mb-3">Visiteurs</p>

        <a href="../controller/controllerAddFrais.php">
            <button class="mb-3 btn btn-secondary">Ajouter un Frais</button>
        </a>

        <h3>Vos fiches frais</h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date de début</th>
                    <th scope="col">Date de fin</th>
                    <th scope="col">Montant renseigné</th>
                    <th scope="col">Montant remboursé</th>
                    <th scope="col">Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../controller/tools.php');
                $ficheFrais = new tools();
                $ficheFrais->displayFicheFrais($db,'visiteur', '');
                ?>
            </tbody>
        </table>
        <?php
        if(isset($_SESSION['popUpNewFicheFrais'])){
            echo '<div class="toast " data-delay="5000" style="position: absolute; top: 126px; right: 0; width: 350px;"> <div class="toast-header bg-success"> <strong class="mr-auto  text-white">Ajout réussis</strong></div><div style="--bs-bg-opacity: .5;" class="toast-body bg-success text-white"> Vous avez ajouté une nouvelle fiche frais avec succès </div> </div>';
            unset($_SESSION['popUpNewFicheFrais']);
        }
        ?>
        
    </span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>