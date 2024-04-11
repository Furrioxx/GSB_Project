<?php


class Api{

    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function login(){
        header('Content-Type: application/json');
        include_once('token.php');
        $mail = $_POST['mail'];
        $pass = $_POST['password'];
    
        $fucntionSQL = new request();
        $result = $fucntionSQL->getUser($this->db, $mail);
    
        if(!empty($result)){
            foreach ($result as $key => $value) {
                if(strlen($pass) > 8){
                    if(password_verify($pass, $value['password'])){
                        $json = array('status' => 200, 'message' => 'connecté', 'token' => generateToken($mail, $this->db));
                        foreach ($result as $key => $value) {
                            $json[$key] = $value;
                        }
                    }
                    else{
                        $json = array('status' => 400, 'message' => 'mauvais password');
                    }
                }
            }
        }
        else{
            $json = array('status' => 400, 'message' => 'mauvais mail');
        }
    
        echo json_encode($json);
    }

    public function getCostSheet(){
        include_once('token.php');

        header('Content-Type: application/json');

        $idUser = $_POST['id'];
        $isTraite = $_POST['isTraite'];
        $token = $_POST['token'];
        $mail = $_POST['mail'];

        if(verifyToken($token, $mail, $this->db)){
            $fucntionSQL = new request();
            $result = $fucntionSQL->getCostSheet($this->db, $idUser);
            $json = array('status' => 200, 'function' => 'get cost sheet');
            foreach ($result as $key => $value) {
                if($isTraite == "T"){
                    if($value['statue'] == $isTraite){
                        $json['data'][$key] = $value;
                    }
                    else{
                        continue;
                    }
                    
                }
                else if($isTraite == "NT"){
                    if($value['statue'] == $isTraite){
                        $json['data'][$key] = $value;
                    }
                    else{
                        continue;
                    }
                }
                else if($isTraite == "all"){
                    $json['data'][$key] = $value;
                }
                
            }  

            echo json_encode($json); 
        }
        else{
            $json = array('status' => 400, 'message' => 'token invalide ou expiré veuillez vous reconnecter', 'mail' => $mail, 'id' => $idUser, "token" => $token, 'isTraite' => $isTraite);
            echo json_encode($json); 
        }
    }

    public function getCost(){
        include_once('token.php');

        header('Content-Type: application/json');

        $idFicheFrais = $_POST['idFicheFrais'];
        $token = $_POST['token'];
        $mail = $_POST['mail'];

        if(verifyToken($token, $mail, $this->db)){
                $fucntionSQL = new request();
                $result = $fucntionSQL->getAllCost($this->db, $idFicheFrais);
                $json = array('status' => 200, 'statut' => 'Succès');
                foreach ($result as $key => $value) {
                        $json['data'][$key] = $value;
                }
        }
        else{
            $json = array('status' => 400, 'message' => 'token invalide ou expiré veuillez vous reconnecter', 'mail' => $mail, 'id' => $idUser, "token" => $token, 'isTraite' => $isTraite);
        }
        echo json_encode($json); 
    }

    public function getCostSheetNT(){
        include_once('token.php');

        header('Content-Type: application/json');
        $token = $_POST['token'];
        $mail = $_POST['mail'];

        if(verifyToken($token, $mail, $this->db)){
            $fucntionSQL = new request();
            $costSheets = $fucntionSQL->getCostSheetComptableNT($this->db);
            $json = array('status' => 200, 'function' => 'get cost sheet NT');
            foreach ($costSheets as $key => $costSheet) {
                $json['data'][$key] = $costSheet;
            }  

            echo json_encode($json); 
        }
        else{
            $json = array('status' => 400, 'message' => 'token invalide ou expiré veuillez vous reconnecter');
            echo json_encode($json); 
        }
    }

    public function deleteCostSheet(){
        include_once('token.php');
        header('Content-Type: application/json');

        $idFicheFrais = $_POST['idFicheFrais'];
        $token = $_POST['token'];
        $mail = $_POST['mail'];

        if(verifyToken($token, $mail, $this->db)){
            $request = new request();
            $request->deleteAllCost($this->db, $idFicheFrais);
            $request->deleteCostSheet($this->db, $idFicheFrais);

            $json = array('status' => 200, 'message' => 'supprimé', 'Fiche Frais supprimé' => $idFicheFrais);
        }
        else{
            $json = array('status' => 400, 'message' => 'token invalide ou expiré veuillez vous reconnecter', 'mail' => $mail, "token" => $token);
        }

        echo json_encode($json);
    }

    public function addCostSheet(){
        header('Content-Type: application/json');
        include_once('token.php');
        include '../controller/tools.php';

        $idUser = $_POST['idUser'];
        $token = $_POST['token'];
        $mail = $_POST['mail'];

        $beginDate = $_POST['beginDate'];
        $endDate = $_POST['endDate'];

        $kmTransport = $_POST['kmTransport'];
        if(isset($_POST['transportMontant']) && !empty($_POST['transportMontant'])){
            $transportMontant = $_POST['transportMontant'];
        }


        $TimeLogement = $_POST['TimeLogement'];
        $priceLogement = $_POST['priceLogement'];

        $restaurantTime = $_POST['restaurantTime'];
        $restaurantPrice = $_POST['restaurantPrice'];

        $libelleOther = $_POST['libelleOther'];
        $montantOther = $_POST['montantOther'];

        if(verifyToken($token, $mail, $this->db)){
            $request = new request;

            if(!empty($beginDate) || !empty($endDate)){
                //vérification de la validité des dates 
                if($beginDate <= $endDate){
                //si au moins 1 frais est remplie :
                    if(!empty($kmTransport) || !empty($transportMontant) || !empty($TimeLogement) || !empty($priceLogement) || !empty($restaurantTime) || !empty($restaurantPrice) || !empty($libelleOther) || !empty($montantOther)){
                        //creer une fiche frais et return son id
                        $idFicheFrais = $request->createFicheFrais($this->db, $beginDate, $endDate, $idUser);
                        if($_POST['transport'] == "car"){   
                            if(!empty($kmTransport)){
                                $tools = new tools();
                                $request->sendFrais($this->db,null,'transport (voiture)', $tools->calculPriceCar($this->db, $kmTransport, $idUser), $kmTransport , $endDate, $idFicheFrais, 'F', null);
                            }
                            else{
                                $request->sendFrais($this->db,null,'transport (voiture)', 0 , 0, $endDate, $idFicheFrais, 'F', null);
                            }
                        }
                        //si le transport est le train
                        else{
                            
                            if(!empty($transportMontant) && isset($_FILES['transportFile'])){
                                $fileDownload = new tools();
                                $request->sendFrais($this->db, null, 'transport (train)', $transportMontant, null, $endDate, $idFicheFrais, 'HF', $fileDownload->downloadImage('../uploads/'.$idUser.'/', 'transportFile'));
                            }
                            else{
                                $request->sendFrais($this->db, null, 'transport (train)', 0, 0, $endDate, $idFicheFrais, 'HF', null);

                            }
                        }
                        //si les champs hebergement on été remplies
                        if(!empty($TimeLogement) && !empty($priceLogement)){
                            if($TimeLogement  != 0){
                                $request->sendFrais($this->db,null,'logement',$priceLogement, $TimeLogement , $endDate, $idFicheFrais, 'F', null);
                            }
                        }
                        else{
                            $request->sendFrais($this->db,null,'logement', 0 , 0 , $endDate, $idFicheFrais, 'F', null);

                        }
                        //si les champs alimentations on été remplies
                        if(!empty($restaurantTime) && !empty($restaurantPrice)){
                            if($restaurantTime != 0){
                                $request->sendFrais($this->db,null,'restauration',$restaurantPrice, $restaurantTime , $endDate, $idFicheFrais, 'F', null);
                            }
                        }
                        else{
                            $request->sendFrais($this->db,null,'restauration',0, 0 , $endDate, $idFicheFrais, 'F', null);
                        }
                        //si le champs autre a été remplies
                        if(!empty($libelleOther) &&  !empty($montantOther) && isset($_FILES['fileOther'])){
                            $fileDownload = new tools();
                            $request->sendFrais($this->db, null, $libelleOther, $montantOther, null, $endDate, $idFicheFrais, 'HF', $fileDownload->downloadImage('../uploads/'.$idUser.'/', 'fileOther'));   
                        }
                        else{
                            $request->sendFrais($this->db, null, 'Autres', 0, 0, $endDate, $idFicheFrais, 'HF', null);   

                        }
                        $request->updatePriceCostSheet($this->db, $idFicheFrais);
                        $json = array('status' => 200, 'statut' => 'Succès', 'id fiche de frais' => $idFicheFrais, 'beginDate' => $beginDate);
                    }
                }
                else{
                    $json = array('status' => 400, 'statut' => 'Erreur', 'Error Message' => 'les dates remplies ne sont pas valides ');
                }
            }
            else{
                $json = array('status' => 400, 'statut' => 'Erreur', 'Error Message' => 'le champs des dates n\'a pas été remplie');
            }
        }else{
            $json = array('status' => 400, 'message' => 'token invalide ou expiré veuillez vous reconnecter', 'mail' => $mail, "token" => $token);
        }

        echo json_encode($json);
    }

    public function changePassword(){
        include_once('token.php');
        header('Content-Type: application/json');

        $token = $_POST['token'];
        $mail = $_POST['mail'];
        $currentPassword = $_POST['currentPassword'];
        $newpassword = $_POST['password'];
        $repassword = $_POST['repassword'];
        $id = $_POST['idUser'];

        if(verifyToken($token, $mail, $this->db)){
            
            $request = new request();
            $passwordInDb = $request->getHashPassword($this->db, $id)['password'];

            if(password_verify($currentPassword, $passwordInDb)){
                if(!empty($newpassword) && !empty($repassword)){
                    if($newpassword == $repassword){
                        $hashPassword = password_hash($newpassword, PASSWORD_DEFAULT);
                        $request->updatePassword($this->db, $hashPassword, $id);
                        $json = array('status' => 200, 'message' => 'mot de passe changé avec succes');
                    }else{
                        $json = array('status' => 400, 'message' => 'different');
                    }
                }else{
                    $json = array('status' => 400, 'message' => 'empty');
                }
            }else{
                $json = array('status' => 400, 'message' => 'Le mot de passe actuel n\'est pas valide');
            }
            
        }
        else{
            $json = array('status' => 400, 'message' => 'token invalide ou expiré veuillez vous reconnecter', 'mail' => $mail, "token" => $token);
        }

        echo json_encode($json);
    }

    public function getCostSheetPerMonth(){
        include_once('token.php');
        header('Content-Type: application/json');

        $token = $_POST['token'];
        $mail = $_POST['mail'];
        $month = $_POST['month'];

        if(verifyToken($token, $mail, $this->db)){
            if($month >= 1 && $month <=12){

                $request = new request();
                $costSheets = $request->getAllCostSheetMonth($this->db, $month);
                $json = array('status' => 200, 'message' => 'succès'); 
                
                foreach ($costSheets as $key => $costSheet) {
                    $json['datas'][$key] = $costSheet; //ajout des fiches de frais dans le json
                    
                    $costs = $request->getAllCost($this->db, $costSheet['idFicheFrais']);
                    foreach ($costs as $keyCost => $cost) {
                        $json['datas'][$key]['detail'][$keyCost] = $cost; //ajout des detail de la fiche de frais dans le json
                    }
                }

                //si aucune fiche de frais valide et payée dans le mois choisi
                if(empty($costSheet)){
                    $json['datas'] = null;
                }

            }else{
                $json = array('status' => 400, 'message' => 'veuillez entrer un mois valide');
            }
        }else{
            $json = array('status' => 400, 'message' => 'token invalide ou expiré veuillez vous reconnecter');
        }

        echo json_encode($json);
    }

    public function getPreciseCost(){
        include_once('token.php');
        header('Content-Type: application/json');

        $token = $_POST['token'];
        $mail = $_POST['mail'];
        $idFrais = $_POST['idFrais'];

        if(verifyToken($token, $mail, $this->db)){
            $request = new request();
            $preciseCost = $request->getPreciseCost($this->db, $idFrais);
            $json = array("status" => 200, "message" => "succès");
            foreach ($preciseCost as $key => $cost) {
                $json['data'] = $cost;
            }
        }else{
            $json = array('status' => 400, 'message' => 'token invalide ou expiré veuillez vous reconnecter test');
        }

        echo json_encode($json);
    }

    public function updateCost(){
        include_once('token.php');
        include '../controller/tools.php';
        header('Content-Type: application/json');

        $token = $_POST['token'];
        $mail = $_POST['mail'];
        $idUser = $_POST['idUser'];
        $newLibelle = $_POST['newLibelle'];
        $newMontant = $_POST['newMontant'];
        $newTiming = $_POST['newTiming'];
        $idFrais = $_POST['idFrais'];
        $idFicheFrais = $_POST['idFicheFrais'];

        if(verifyToken($token, $mail, $this->db)){
            if(isset($newLibelle) && isset($newMontant) && isset($newTiming)){
                $request = new request();
                $currentCost = $request->getPreciseCost($this->db, $idFrais);

                //pour les frais qui possède un justificatif (transport train et autre)
                if(isset($_FILES['newJustif']) && $_FILES['newJustif']["error"] == 0){
                    $tools = new tools();
                    $request->updateFrais($this->db, $newLibelle, $newMontant, $newTiming, $tools->downloadImage('../uploads/'.$idUser.'/', 'newJustif'), $idFrais);
                }
                else{
                    //pour les frais qui ne possède pas de justificatif
                    if($newLibelle == "transport (voiture)"){
                        $tools = new tools();
                        $cost = $tools->calculPriceCar($this->db, $newTiming, $idUser);
                        $request->updateFrais($this->db, $newLibelle, $cost, $newTiming, $currentCost[0]['linkJustif'], $idFrais);
                        
                    }else{
                        $request->updateFrais($this->db, $newLibelle, $newMontant, $newTiming, $currentCost[0]['linkJustif'], $idFrais);
                    }
                    
                }
                $request->updatePriceCostSheet($this->db, $idFicheFrais);
                $json = array("status" => 200, "message" => "La fiche de frais à été mise a jour", "idFrais" => $idFrais);

            }else{
                $json = array('status' => 400, 'message' => 'les données n\'ont pas toutes été envoyé');
            }
        }else{
            $json = array('status' => 400, 'message' => 'token invalide ou expiré veuillez vous reconnecter test');
        }

        echo json_encode($json);
    }
}
