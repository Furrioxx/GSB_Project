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
        <a href="../controller/dashboard.php"><button class="btn btn-primary mb-3">Retour</button></a>
        <h2><?php echo $title; ?></h2>
        <p class="mb-3">comptable</p>
        
        <h3>Fiche frais traitées</h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date de début</th>
                    <th scope="col">Date de fin</th>
                    <th scope="col">Montant renseigné</th>
                    <th scope="col">Montant remboursé</th>
                    <th scope="col">Nom du visiteur</th>
                    <th scope="col">photo de profil</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../controller/tools.php');
                $ficheFrais = new tools();
                $ficheFrais->displayFicheFrais($db,'comptable', 't');
                ?>
            </tbody>
        </table>

    </span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>