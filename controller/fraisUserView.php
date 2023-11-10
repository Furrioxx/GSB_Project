<?php

include('../model/config.php');
include('../model/functionSQL.php');

$request = new request;
foreach ($request->getCostNotInclued($db) as $key => $value) {
    echo '<div class="frais"><p>Libellé : '.$value['libelle'].' </p><p>Montant : '.$value['montant'].'</p><p>Date : '.$value['dateligne'].'</p></div>';
}