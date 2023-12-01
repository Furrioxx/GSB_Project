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
        <div class="chartContainer">
            <div>
                <h2><?php echo $title; ?></h2>
                <p class="mb-3">Visiteurs</p>
        
                <a href="../controller/controllerAddFrais.php">
                    <button class="mb-3 btn btn-secondary">Ajouter un Frais</button>
                </a>
        
            </div>
            <div class="mr-2">
                <canvas id="myChart"></canvas>
            </div>
        </div>

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
                $tools = new tools();
                $tools->displayFicheFrais($db,'visiteur', '');
                ?>
            </tbody>
        </table>
        <?php
        if(isset($_SESSION['popUpNewFicheFrais'])){
            echo '<div class="toast " data-delay="5000" style="position: absolute; top: 126px; right: 0; width: 350px;"> <div class="toast-header bg-success"> <strong class="mr-auto  text-white">Ajout réussis</strong></div><div style="--bs-bg-opacity: .5;" class="toast-body bg-success text-white"> Vous avez ajouté une nouvelle fiche frais avec succès </div> </div>';
            unset($_SESSION['popUpNewFicheFrais']);
        }
        if(isset($_SESSION['popupModifPass'])){
            echo '<div class="toast " data-delay="5000" style="position: absolute; top: 126px; right: 0; width: 350px;"> <div class="toast-header bg-success"> <strong class="mr-auto  text-white">Modification réussis</strong></div><div style="--bs-bg-opacity: .5;" class="toast-body bg-success text-white"> Vous avez modifié votre mot de passe avec succès </div> </div>';
            unset($_SESSION['popupModifPass']);
        }
        if(isset($_SESSION['popUpNewPP'])){
            echo '<div class="toast " data-delay="5000" style="position: absolute; top: 126px; right: 0; width: 350px;"> <div class="toast-header bg-success"> <strong class="mr-auto  text-white">Modification réussis</strong></div><div style="--bs-bg-opacity: .5;" class="toast-body bg-success text-white"> Vous avez modifié votre photo de profil avec succès </div> </div>';
            unset($_SESSION['popUpNewPP']);
        }
        ?>
        
    </span>
</body>
<script>
    <?php
         $data = $tools->getDataForCharts($db);
    ?>
  const ctx = document.getElementById('myChart');
  const data = {
  labels: [
    'Frais renseignés',
    'Frais remboursés',
  ],
  datasets: [{
    label: 'Montant en euros',
    data: <?php echo '['.round($data['sum_montant'], 2).', '.round($data['sum_refund_montant'], 2).']'; ?>,
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)'
    ],
    hoverOffset: 4
  }]
};
  new Chart(ctx, {

    type: 'doughnut',
    data: data,
    options: {
        responsive : true,
    }
  });
</script>
<script src="../dist/viewDashboard.js"></script>
</html>