<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');

class detailFicheFrais{
    public function __construct()
    {
        
    }

    public function displayAllFraisVisiteur($db, $idFicheFrais){
        $request = new request();
        $allFrais = $request->getAllCost($db, $idFicheFrais);
        foreach ($allFrais as $key => $value) {
            $statutFicheFrais = $value['statue'];
            $montantTotal =  $value['montant_total'];
            if($value['statue'] != 'NT'){
                if($value['statu'] == "F"){
                    if($value['linkJustif'] != ''){
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].'</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td></tr>';
                    }
                    else{
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].'</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td>-</td></tr>';
                    }
                }
                else{
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].'</td><td>'.$value['dateligne'].'</td><td>Hors Forfait</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td></tr>';
                }
            }
            else{
                if($value['statu'] == "F"){
                    if($value['linkJustif'] != ''){
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].'</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td></tr>';
                    }
                    else{
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].'</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td>-</td></tr>';
                    }
                }
                else{
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].'</td><td>'.$value['dateligne'].'</td><td>Hors Forfait</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td></tr>';
                }
            }
        }
        echo "<p class='mb-3'>Montant total : ".$montantTotal." €</p>";
        echo "<p class='mb-3'>Etat de la fiche frais : ".$statutFicheFrais."</p>";      
    }
}

if(isset($_SESSION['name'])){
    //si on viens de pageVisiteur/Comptable et qu'on a cliqué sur le bouton 'Voir plus'
    if(isset($_POST['seeFicheFrais'])){
        $idFicheFrais = $_POST['idFicheFrais'];
        include('../vue/vueDetailFicheFrais.php');
    }
    else{
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}

?>