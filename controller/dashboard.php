<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');

class ficheFrais{
    public function __construct()
    {
        
    } 

    public function displayFicheFrais($db,$role){
        $request = new request;
        if($role == 'visiteur'){
            //affichage des fiches frais dans un tableau
            foreach($request->getCostSheet($db) as $key => $value){
                //si les fiche frais ne sont pas traité
                if($value['statue'] == 'NT'){
                    $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-7" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M12 12l-2 3"></path><path d="M12 7v5"></path></svg>';
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['beginDate'].'</td><td>'.$value['endDate'].'</td><td>'.$value['montant_total'].' €</td><td>-</td><td>'.$icon.' En attente</td><td><form action="detailFicheFrais.php" method="post"><input type="number" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display : none"><input type="submit" name ="seeFicheFrais" value ="Voir plus" class="btn btn-primary"></form></td></tr>';
                }
                //si les fiche frais sont accepté
                else if($value['statue'] == 'A'){

                }
                //si les fiche frais sont refusées
                else if($value['statue'] == 'R'){
                    
                }
            }
        }
        else if ($role == 'comptable'){
            foreach($request->getCostSheetComptableNT($db) as $key => $value){
                //si le visiteur n'a pas de pp
                if($value['ppLink'] == ''){
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['beginDate'].'</td><td>'.$value['endDate'].'</td><td>'.$value['montant_total'].' €</td><td>'.$value['name']." ".$value['surname'].'</td><td><img src="../src/user.jpg" alt="user image" style="height:50px;"<td><td><form action="detailFicheFrais.php" method="post"><input type="number" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display : none"><input type="submit" name ="seeFicheFrais" value ="Voir plus" class="btn btn-primary"></form></td></tr>';
                }
                else{
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['beginDate'].'</td><td>'.$value['endDate'].'</td><td>'.$value['montant_total'].' €</td><td>'.$value['name']." ".$value['surname'].'</td><td><img src="'.$value['ppLink'].'" alt="user image" style="height:50px;"></td><td><form action="detailFicheFrais.php" method="post"><input type="number" name="idFicheFrais" value="'.$value['idFicheFrais'].'" style="display : none"><input type="submit" name ="seeFicheFrais" value ="Voir plus" class="btn btn-primary"></form></td></tr>';
                }
                
            }
        }
    }
}

$valueDeco = "";

// vérification de la provenance de l'utilisateur
if(isset($_SESSION['name'])){

    // destrcution de la variable erreur message
    if(isset($_SESSION['error_msg'])){
        unset($_SESSION['error_msg']);
    }
    $valueDeco = 'Déconnexion';
    $title = "Bonjour " .   $_SESSION['name'];
    if($_SESSION['statut'] == 'visiteur'){
        include('../vue/pageVisiteur.php');
    }
    else if ($_SESSION['statut'] == 'comptable'){
        include('../vue/pageComptable.php');
    }
    else if($_SESSION['statut'] == 'admin'){
        include('../vue/pageAdmin.php');
    }
}
else{
    $title = "Veuillez vous connecter pour accéder à votre dashboard";
    $valueDeco = 'Se connecter';
    include('../vue/pageErreur.php');
}


?>

