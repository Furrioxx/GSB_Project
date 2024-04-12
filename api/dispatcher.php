<?php

include_once "api.php";
include('../model/functionSQL.php');


try {
    if (!empty($_GET['route'])) {
    $url = explode("/", filter_var($_GET['route'], FILTER_SANITIZE_URL));
    
    switch ($url[0]) {
        case "login":
            if (empty($url[1])) {
                $api = new Api($db);
                $api->login();
            }
            break;
        case "getCostSheet":
            if (empty($url[1])) {
                $api = new Api($db);
                $api->getCostSheet();
            }
            break;
        case "getCost":
            if (empty($url[1])) {
                $api = new Api($db);
                $api->getCost();
            }
            break;
        case "deleteCostSheet":
            if(empty($url[1])){
                $api = new Api($db);
                $api->deleteCostSheet();
            }
            break;
        case "addCostSheet":
            if(empty($url[1])){
                $api = new Api($db);
                $api->addCostSheet();
            }
            break;
        case "changePassword":
            if(empty($url[1])){
                $api = new Api($db);
                $api->changePassword();
            }
            break;
        case "getCostSheetPerMonth":
            if(empty($url[1])){
                $api = new Api($db);
                $api->getCostSheetPerMonth();
            }
            break;
        case "getPreciseCost":
            if(empty($url[1])){
                $api = new Api($db);
                $api->getPreciseCost();
            }
            break;
        case "getCostSheetNT":
            if(empty($url[1])){
                $api = new Api($db);
                $api->getCostSheetNT();
            }
            break;
        case "updateCost":
            if(empty($url[1])){
                $api = new Api($db);
                $api->updateCost();
            }
            break;
        case "getAllCostHF":
            if(empty($url[1])){
                $api = new Api($db);
                $api->getAllCostHF();
            }
            break;
        default:
            throw new Exception("La demande n'est pas valide, vérifiez l'url");
    }
} else {
    throw new Exception("Problème de récupération de données");
}
} catch (Exception $e) {
    $erreur = [
        "message" => $e->getMessage(),
        "code" => $e->getCode()
    ];
    print_r($erreur);
}