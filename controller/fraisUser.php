<?php
session_start();
include('../model/functionSQL.php');
include('../model/config.php');

if(isset($_POST['submit'])){
    $beginDate = $_POST['beginDate'];
    $endDate = $_POST['endDate'];

    $kmTransport = $_POST['kmTransport'];
    if(isset($_POST['transportMontant'])){
        $transportMontant = $_POST['transportMontant'];
        $transportFile = $_POST['transportFile'];
    }
    

    $TimeLogement = $_POST['TimeLogement'];
    $priceLogement = $_POST['priceLogement'];

    $restaurantTime = $_POST['restaurantTime'];
    $restaurantPrice = $_POST['restaurantPrice'];

    $libelleOther = $_POST['libelleOther'];
    $montantOther = $_POST['montantOther'];
    $fileOther =  $_POST['fileOther'];
    
    $request = new request;

    //si les dates sont remplies
    if(!empty($beginDate)|| !empty( $endDate)){
        //vérification de la validité des dates 
        if($beginDate <= $endDate){
        //si au moins 1 frais est remplie :
            if(!empty($kmTransport) || !empty($transportMontant) || !empty($transportFile) || !empty($NameLogement) || !empty($priceLogement) || !empty($restaurantName) || !empty($restaurantPrice) || !empty($libelleOther) || !empty($montantOther) || !empty($fileOther)){
                //creer une fiche frais et return son id
                $idFicheFrais = $request->createFicheFrais($db, $beginDate, $endDate);
                if($_POST['transport'] == "car"){   
                    if(!empty($kmTransport)){
                        $CVCarUser = $request->getCvCarUser($db)['cvcar'];  
                        if($kmTransport <= 5000){
                            if($CVCarUser <= 3){
                                $cost = 0.529*$kmTransport;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                            else if ($CVCarUser == 4){
                                $cost = 0.606*$kmTransport;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                            else if ($CVCarUser == 5){
                                $cost = 0.636*$kmTransport;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                            else if ($CVCarUser == 6){
                                $cost = 0.665*$kmTransport;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                            else if ($CVCarUser >= 7){
                                $cost = 0.697*$kmTransport;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                        }
                        else if($kmTransport > 5000 &&  $kmTransport <= 20000){
                            if($CVCarUser <= 3){
                                $cost = 0.316*$kmTransport + 1061;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                            else if ($CVCarUser == 4){
                                $cost = 0.340*$kmTransport + 1330;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                            else if ($CVCarUser == 5){
                                $cost = 0.356*$kmTransport + 1391;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                            else if ($CVCarUser == 6){
                                $cost = 0.374*$kmTransport + 1457;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                            else if ($CVCarUser >= 7){
                                $cost = 0.394*$kmTransport + 1512;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                        }
                        else if($kmTransport > 20000){
                            if($CVCarUser <= 3){
                                $cost = 0.369*$kmTransport;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                            else if ($CVCarUser == 4){
                                $cost = 0.408*$kmTransport;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                            else if ($CVCarUser == 5){
                                $cost = 0.427*$kmTransport;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                            else if ($CVCarUser == 6){
                                $cost = 0.448*$kmTransport;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                            else if ($CVCarUser >= 7){
                                $cost = 0.470*$kmTransport;
                                $request->sendFrais($db,null,'transport',$cost, $endDate, $idFicheFrais, 0);
                            }
                        }
                    }
                }
                else{
                    //si  c'est le train
                    if(!empty($transportMontant) && !empty($transportFile)){
                        //requete
                    }
                }
                if(!empty($TimeLogement) && !empty($priceLogement)){
                    //requete
                }
                if(!empty($restaurantTime) && !empty($restaurantPrice)){
                    //requete
                }
                if(!empty($libelleOther) &&  !empty($montantOther) && !empty($fileOther)){
                    //requete
                }
                $request->updatePriceCostSheet($db, $idFicheFrais);
            }
            else{
                //message erreur, aucun des champs ont été remplies (outre les dates)
            }
        }
        else{
            //message erreur, les dates ne vont pas (debut supérieur a fin)
        }
    }
    else{
        //message erreur, les dates n'ont  pas été indiqué
    }
    // $request->insertFraisNotInclued($db);
    // header('Location: dashboard.php');
}

?>