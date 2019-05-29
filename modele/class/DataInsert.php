<?php

require_once 'Data.php';

class DataInsert extends Data {

    protected $_db;

    public function __construct($db) {
        return $this->_db = $db;
    }

    public function DataCheck($pseudo, $email, $password) {
        
        $req = false;
        //preparation de la requete
        $reponse = $this->_db->prepare('SELECT * FROM user');
        $reponse->execute();
        $datas = $reponse->fetchAll();
        foreach ($datas as $data) {
            if ($data['name_user'] === $pseudo) {
                return $req = true;
                break;
            }
            if ($data['email_user'] === $email){
                return $req = true;
                break;
            }
        }
        if ($req == false) {
            $this->add($pseudo, $email, $password);
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
