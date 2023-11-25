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
        <p class="mb-3">Admin</p>

        <a href="../controller/controllerAddUser.php">
            <button class="btn mb-3 btn-secondary">Ajouter un utilisateur</button>
        </a>

        <div>
            <a href="../controller/controllerModifyMaxRefund.php">
                <button class="btn mb-3 btn-secondary">Modifier les remboursements maximum</button>
            </a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">login</th>
                    <th scope="col">Date d'embauche</th>
                    <th scope="col">photo de profile</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../controller/tools.php');
                $ficheFrais = new tools();
                $ficheFrais->displayUsers($db);
                ?>
            </tbody>
        </table>
    </span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>