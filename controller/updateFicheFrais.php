<?php
session_start();
include('../model/config.php');
include('../model/functionSQL.php');

class updateFraisClass{
    public function __construct()
    {
        
    }

}

if(isset($_SESSION['name'])){
    //si on viens de pageVisiteur/Comptable et qu'on a cliqué sur le bouton 'Voir plus'
    if(isset($_POST['updateFrais'])){
        $idFrais = $_POST['idFrais'];
        $libelleFrais = $_POST['libelleFrais'];
        include('../vue/vueUpdateFrais.php');
        $request = new request();
        var_dump($request->getPreciseCost($db, $idFrais));
    }
    else{
        header('Location: dashboard.php');
    }
}
else{
    header('Location: dashboard.php');
}