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
            $montantTotal =  $value['montant_total'];
            //si la fiche frais n'est pas traité
            if($_SESSION['statut'] == 'visiteur'){
                $isModifyButton = '<form action="updateFicheFrais.php" method="post"><input type="number" name="idFrais" value="'.$value['id'].'" style="display : none"><input name="libelleFrais" type="text" value="'.$value['libelle'].'" style="display : none"><input type="submit" name ="updateFrais" value ="Modifier" class="btn btn-primary"></form>';
            }
            else{
                $isModifyButton = '';
            }
            if($value['statue'] == 'NT'){
                $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-7" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M12 12l-2 3"></path><path d="M12 7v5"></path></svg>';
                //si le frais est forfaitaire
                if($value['statu'] == "F"){
                    if($value['linkJustif'] != ''){
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].'</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td><td>'.$isModifyButton.'</td></tr>';
                    }
                    else{
                        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].'</td><td>'.$value['dateligne'].'</td><td>Forfaitaire</td><td>-</td><td>'.$isModifyButton.'</td></tr>';
                    }
                }
                else{
                    echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['libelle'].'</td><td>'.$value['timing'].'</td><td>'.$value['montant'].'</td><td>'.$value['dateligne'].'</td><td>Hors Forfait</td><td><a href="'.$value['linkJustif'].'" target="_blank">Voir le Justificatif</a></td><td>'.$isModifyButton.'</td></tr>';
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
        echo "<p class='mb-3'>Etat de la fiche frais : ".$icon." En attente</p>";      
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