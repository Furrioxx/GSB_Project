<?php

include('../model/config.php');
include('../model/functionSQL.php');
$request = new request;
// var_dump($request->getCostSheet($db));

foreach($request->getCostSheet($db) as $key => $value){
    if($value['statue'] == 'NT'){
        echo '<tr><th scope="row">'.($key+1).'</th><td>'.$value['beginDate'].'</td><td>'.$value['endDate'].'</td><td>'.$value['montant'].'</td><td>-</td><td>'.$value['statue'].'</td></tr>';
    }
}

// $request = new request;
// foreach ($request->getCostNotInclued($db) as $key => $value) {
//     echo '<div class="frais"><p>Libellé : '.$value['libelle'].' </p><p>Montant : '.$value['montant'].'</p><p>Date : '.$value['dateligne'].'</p></div>';
// }