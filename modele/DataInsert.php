<?php
require_once 'Data.php';
require_once 'Session.php';

class DataInsert extends Data {

    protected $_db;

    public function __construct($db) {
        return $this->_db = $db;
    }

    public function DataCheck($pseudo, $email, $password) {
        
        $reqName = false;
        $reqEmail = false;
        //preparation de la requete
        $reponse = $this->_db->prepare('SELECT * FROM user');
        $reponse->execute();
        $datas = $reponse->fetchAll();
        foreach ($datas as $data) {
            if ($data['name_user'] === $pseudo) {
                return $reqName = true;
                break;
            }
            if ($data['email_user'] === $email){
                return $reqEmail = true;
                break;
            }
        }
        if ($reqName === false AND $reqEmail === false) {
            $this->add($pseudo, $email, $password);
            $sessionStock = new Session();
            $sessionStock->addSession('name', $pseudo);
            header('Location: ../public/profil');
            exit();
        } 
        if ($reqName === true) {
            $session = new Session();
            $session->addSession('errorName', 'Le nom que vous avez choisi est déjà utlisées : ' . $pseudo);
            header('Location: ../public/inscription');
            exit();
        }
        if ($reqName === true) {
            $session = new Session();
            $session->addSession('errorEmail', 'L\'email que vous avez choisi est déjà utlisées : ' . $email);
            header('Location: ../public/inscription');
            exit();
        }
    }

    private function add($pseudo, $email, $password) {
        $req = $this->_db->prepare('INSERT INTO user(name_user, email_user, password_user, date_inscription) VALUES (:pseudo, :email, :password, CURDATE())');
        $req->bindValue(':pseudo', $pseudo);
        $req->bindValue(':email', $email);
        $req->bindValue(':password', $password);
        $req->execute();
    }
}

