<?php
require_once 'Data.php';
require_once 'Session.php';

class DataInsert extends Data {

    //Ajoute le nom a la session
    private function addSession($data) {
        $session = new Session();
        $session->addSession('name', $data);
    }

    //Ajoute utilisateur a la base de donnees
    public function add($pseudo, $email, $password) {
        $req = $this->_db->prepare('INSERT INTO user(name_user, email_user, password_user, date_inscription) VALUES (:pseudo, :email, :password, CURDATE())');
        $req->bindValue(':pseudo', $pseudo);
        $req->bindValue(':email', $email);
        $req->bindValue(':password', $password);
        $req->execute();
        $this->addSession($pseudo);
    }
}

