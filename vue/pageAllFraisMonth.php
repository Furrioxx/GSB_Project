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

        <form action="../controller/allFraisMonth.php" method="post" class="mb-3">
            <select name="month" id="month" class="form-select" required>
                <option value="" selected disabled>-- Selectionner un mois --</option>
                <option value="1">janvier</option>
                <option value="2">février</option>
                <option value="3">mars</option>
                <option value="4">avril</option>
                <option value="5">mai</option>
                <option value="6">juin</option>
                <option value="7">juillet</option>
                <option value="8">aôut</option>
                <option value="9">septembre</option>
                <option value="10">octobre</option>
                <option value="11">novembre</option>
                <option value="12">décembre</option>
            </select>
            <input type="submit" value="Valider" name="changeMonth" class="btn btn-primary mt-3">
            
        </form>
        
        <h3>Frais du mois</h3>

        <?php
            include('../controller/tools.php');
            $tools = new tools();
            if($isMonthSelected){
                $tools->display_total_refund_month($db, $isMonthSelected);
            }
            
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">libelle</th>
                    <th scope="col">durée / distance</th>
                    <th scope="col">Montant remboursé</th>
                    <th scope="col">Montant remboursé</th>
                    <th scope="col">statut</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($isMonthSelected){
                    $tools->displayFraisMonth($db, $isMonthSelected);
                }
                else{
                    echo '<tr><td colspan="6">Veuillez selectionner un mois</td></tr>';
                }
                
                // $ficheFrais = new tools();
                // $ficheFrais->displayFicheFrais($db,'comptable', 't');
                ?>
            </tbody>
        </table>

    </span>
</body>
<script src="../dist/viewDashboard.js"></script>
</html>