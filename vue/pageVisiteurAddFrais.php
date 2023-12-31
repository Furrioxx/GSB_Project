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
        <p class="mb-3">visiteur</p>       
        
        <form action="../controller/addFraisUser.php" method="post" enctype="multipart/form-data" onsubmit="return formValidation()">
            <h2>Frais Forfait</h2>
            <div class="mb-3">
                <label for="beginDate">Date de début : </label>
                <input type="date" placeholder="Date de début" name="beginDate" class="form-control p-2" id="beginDate" required>
            </div>
            <div class="mb-3">
                <label for="endDate">Date de fin : </label>
                <input type="date" placeholder="Date de Fin" name="endDate" class="form-control p-2" id="endDate" required>
            </div>
            <h3>Transport</h3>
            <div class="mb-3">
                <label for="car">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-car" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M5 17h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5"></path>
                </svg>
                </label>
                <input type="radio" class="form-check-input" name="transport" id="car" value="car" checked>
                
                <label for="train">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-train" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M21 13c0 -3.87 -3.37 -7 -10 -7h-8"></path>
                        <path d="M3 15h16a2 2 0 0 0 2 -2"></path>
                        <path d="M3 6v5h17.5"></path>
                        <path d="M3 10l0 4"></path>
                        <path d="M8 11l0 -5"></path>
                        <path d="M13 11l0 -4.5"></path>
                        <path d="M3 19l18 0"></path>
                    </svg>
                </label>
                <input type="radio" name="transport" class="form-check-input" value="train" id="train">
            </div>
            <div class="mb-3 transportDiv">
                <input type="number" placeholder="Entrez le nombre de kilomètre parcouru" step="0.1" name="kmTransport" class="form-control p-2">
            </div>
            <h3>Hébergement</h3>
            <div class="mb-3">
                <input type="number" placeholder="Nombre de nuité" name="TimeLogement" id="TimeLogement" class="form-control p-2" >
            </div>
            <div class="mb-3">
                <input type="number" step="0.01" placeholder="Montant de l'hébergement <?php echo '( ' . $maxRefund1night . ' € par nuit )';?>" id="priceLogement" name="priceLogement" class="form-control p-2" >
            </div>
            <h3>Alimentation</h3>
            <div class="mb-3">
                <input type="text" placeholder="Nombre de repas" id="restaurantTime" name="restaurantTime" class="form-control p-2" >
            </div>
            <div class="mb-3">
                <input type="number" step="0.01" placeholder="Montant de l'addition <?php echo '( ' . $maxRefund1meal . ' € par repas )';?>" id="restaurantPrice" name="restaurantPrice" class="form-control p-2" >
            </div>

            <h3>Autre</h3>
            <div class="mb-3">
                <input type="text" name ="libelleOther" id="libellOther" placeholder ="libelle" class="form-control p-2" >
            </div>
            <div class="mb-3">
                <input type="number" step="0.01" name ="montantOther" id="montantOther" placeholder ="montant" class="form-control p-2" >
            </div>
            <div class="mb-3">
                <label for="fileOther">Justificatifs : </label>
                <input type="file" name ="fileOther" id="fileOther" class="form-control p-2">
            </div>
            <div class="mb-3">
                <?php
                    if(isset($_SESSION['error_msg_dashboard'])){
                        echo '<p class="err">'. $_SESSION['error_msg_dashboard'].'</p>';
                    }
                ?>
            </div>
            <div class="mb-3">
                <input type="submit" name ="submit" value ="valider" class="btn btn-primary">
                <p class="err err-message"></p>
            </div>
        </form>

</body>
<script src="../dist/viewDashboard.js"></script>
</html>