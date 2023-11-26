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

        <?php
        if(isset($_SESSION['popUpAddUser'])){
            echo '<div class="toast " data-delay="5000" style="position: absolute; top: 126px; right: 0; width: 350px;"> <div class="toast-header bg-success"> <strong class="mr-auto  text-white">Ajout réussis</strong></div><div style="--bs-bg-opacity: .5;" class="toast-body bg-success text-white"> Vous avez ajouté un nouvel utilisateur avec succès </div> </div>';
            unset($_SESSION['popUpAddUser']);
        }
        if(isset($_SESSION['popUpModifyMaxRefund'])){
            echo '<div class="toast " data-delay="5000" style="position: absolute; top: 126px; right: 0; width: 350px;"> <div class="toast-header bg-success"> <strong class="mr-auto  text-white">Modification réussis</strong></div><div style="--bs-bg-opacity: .5;" class="toast-body bg-success text-white"> Vous avez modifié les montant remboursé avec succès </div> </div>';
            unset($_SESSION['popUpModifyMaxRefund']);
        }
        if(isset($_SESSION['popupDesactiveUser'])){
            echo '<div class="toast " data-delay="5000" style="position: absolute; top: 126px; right: 0; width: 350px;"> <div class="toast-header bg-success"> <strong class="mr-auto  text-white">Désactivation réussis</strong></div><div style="--bs-bg-opacity: .5;" class="toast-body bg-success text-white"> Vous avez désactivé l\'utilisateur avec succès </div> </div>';
            unset($_SESSION['popupDesactiveUser']);
        }
        if(isset($_SESSION['popupModifUserAdmin'])){
            echo '<div class="toast " data-delay="5000" style="position: absolute; top: 126px; right: 0; width: 350px;"> <div class="toast-header bg-success"> <strong class="mr-auto  text-white">Modification réussis</strong></div><div style="--bs-bg-opacity: .5;" class="toast-body bg-success text-white"> Vous avez modifié l\'utilisateur avec succès </div> </div>';
            unset($_SESSION['popupModifUserAdmin']);
        }
        if(isset($_SESSION['popupModifPass'])){
            echo '<div class="toast " data-delay="5000" style="position: absolute; top: 126px; right: 0; width: 350px;"> <div class="toast-header bg-success"> <strong class="mr-auto  text-white">Modification réussis</strong></div><div style="--bs-bg-opacity: .5;" class="toast-body bg-success text-white"> Vous avez modifié votre mot de passe avec succès </div> </div>';
            unset($_SESSION['popupModifPass']);
        }
        ?>

    </span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>