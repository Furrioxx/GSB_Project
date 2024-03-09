<?php

include_once "api.php";
include('../model/functionSQL.php');


try {
    if (!empty($_GET['route'])) {
    $url = explode("/", filter_var($_GET['route'], FILTER_SANITIZE_URL));
    // print_r($url);
    // Filtré l'URL et ajoute de la sécurité.
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
        // case "article":
        //     if (!empty($url[1])) {
        //         getArticleById($url[1]);
        //     } else {
        //         throw new Exception("Vous n'avez pas renseigné le numéro de l'article");
        //     }
        //     break;
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