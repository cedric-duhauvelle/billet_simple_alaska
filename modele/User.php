<?php
require_once 'Data.php';

class User {
    private $_id;
    private $_pseudo;
    private $_email;
    private $_password;
    private $_db;

    public function setPseudo($pseudo) {
        if (is_string($pseudo)) {
            $this->_pseudo = $pseudo;
            return $this->_pseudo;
        }
    }
    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->_email = $email;
            return $this->_email;
        }
    }
    public function setPassword($password, $passwordConfirm) {
        if ($password === $passwordConfirm) {
            $this->_password = htmlspecialchars(password_hash($password, PASSWORD_DEFAULT));
            return $this->_password;
        } else {
            $sessionStock = new Session();
            $sessionStock->addSession('errorPassword', 'Les mots de passes ne sont pas identiques.');
            header('location: ../public/inscription');

        }
    }
    public function addDb($db) {
        return $this->_db = $db;    
    }

    public function addUserDb() {
        $this->DataCheck($this->_pseudo, $this->_email, $this->_password);
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
                $reqName = true;
            }
        }
        foreach ($datas as $data) {
            if ($data['email_user'] === $email){
                $reqEmail = true;
            }
        }
        if ($reqName === false AND $reqEmail === false) {
            $this->add($pseudo, $email, $password);
            $sessionStock = new Session();
            $sessionStock->addSession('name', $pseudo);
            header('Location: ../public/profil');
        }
        if ($reqName === true) {
            $session = new Session();
            $session->addSession('errorName', 'Le nom que vous avez choisi est déjà utlisées : ' . $pseudo);            
            header('Location: ../public/inscription');
        } 
        if ($reqEmail === true) {
            $session = new Session();
            $session->addSession('errorEmail', 'L\'email que vous avez choisi est déjà utlisées : ' . $email);   
            header('Location: ../public/inscription');
        }
        var_dump($reqName);
        var_dump($reqEmail);
    }

    private function add($pseudo, $email, $password) {
        $req = $this->_db->prepare('INSERT INTO user(name_user, email_user, password_user, date_inscription) VALUES (:pseudo, :email, :password, CURDATE())');
        $req->bindValue(':pseudo', $pseudo);
        $req->bindValue(':email', $email);
        $req->bindValue(':password', $password);
        $req->execute();
    }
}