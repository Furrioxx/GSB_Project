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

        <form action="../controller/addUser.php" method="post" enctype="multipart/form-data">
            <h2>Ajouter un nouvel utilisateur</h2>

            <div class="mb-3">
                <input type="text" name ="nameUser" placeholder ="Nom de l'utilisateur" class="form-control p-2" required>
            </div>
            <div class="mb-3">
                <input type="text" name ="surnameUser" placeholder ="Nom de famille de l'utilisateur" class="form-control p-2" required>
            </div>
            <div class="mb-3">
                <input type="mail" name ="loginUser" placeholder ="Login de l'utilisateur" class="form-control p-2" required>
            </div>
            <div class="mb-3">
                <input type="text" name ="adressUser" placeholder ="Adresse de l'utilisateur" class="form-control p-2" required>
            </div>
            <div class="mb-3">
                <input type="number" name ="cpUser" placeholder ="Code postal de l'utilisateur" class="form-control p-2" required>
            </div>
            <div class="mb-3">
                <input type="text" name ="villeUser" placeholder ="Ville de l'utilisateur" class="form-control p-2" required>
            </div>
            <div class="mb-3">
                <label for="">Date d'embauche de l'utilisateur : </label>
                <input type="date" name ="dateUser" class="form-control p-2" required>
            </div>
            <div class="mb-3">
                <select name="statutUser" id="statutUser" class="form-select" required>
                    <option value="" selected disabled>-- Choisir le statut de l'utilisateur --</option>
                    <option value="visiteur">Visiteur</option>
                    <option value="comptable">Comptable</option>
                </select>
            </div>
            <div class="mb-3">
                <input type="number" name ="cvCarUser" placeholder ="Chevaux de la voiture de l'utilisateur" class="form-control p-2" required>
            </div>
            <div class="mb-3">
                <input type="submit" name ="submit" value ="Ajouter" class="btn btn-primary">
                <p class="err err-message"></p>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">login</th>
                    <th scope="col">password</th>
                    <th scope="col">Date d'embauche</th>
                    <th scope="col">photo de profile</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ficheFrais = new toolsDisplay();
                $ficheFrais->displayUsers($db);
                ?>
            </tbody>
        </table>
    </span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>