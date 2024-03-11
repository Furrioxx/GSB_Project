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
}
