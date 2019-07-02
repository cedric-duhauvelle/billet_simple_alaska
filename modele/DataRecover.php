<?php
require_once 'Data.php';
require_once 'Session.php';

class DataRecover extends Data {
    
    private $_id;
    private $_passwordHash;
    private $_responseName;
    private $_responsePassword;

    //Recherche si utilissateur est enregistrer a la base de donnees
    public function connectUser($pseudo, $password) {
        $this->namecheck($pseudo);
        $this->passwordCheck($password);
        if ($this->_responseName === 0) {
            $session = new Session();
            $session->addSession('errorName', 'Nom incorrect');
            header('Location: connexion');
        } elseif ($this->_responseName === 1 && $this->_responsePassword === true) {
            $session = new Session();
            $session->addSession('name', $pseudo);
            $session->addSession('id_user', $this->_id);
            header('Location: profil');
        } elseif ($this->_responseName === 2 && $this->_responsePassword === true) {
            $session = new Session();
            $session->addSession('name', $pseudo);
            $session->addSession('id_user', $this->_id);
            $session->addSession('admin', $this->_responseName);
            header('Location: administrateur');
        } elseif (($this->_responseName === 1 || $this->_responseName === 2) && $this->_responsePassword === false) {
            $session = new Session();
            $session->addSession('errorPassword', 'Mot de pase incorrect');
            header('Location: connexion');
        } 
    }

    //Verifie nom  
    public function nameCheck($pseudo) {
        $this->_responseName = 0;
        $this->callDisplay('users');
        foreach ($this->_responses as $response) {
            if ($pseudo == $response['name']) {
                $this->_id = $response['id'];
                $this->_responseName = 1;
            } elseif ('admin' == $pseudo) {
                $this->_responseName = 2;
            }  
        }
        return $this->_responseName;
    }

    //Verifie mot de passe 
    public function passwordCheck($password) {
        $this->callDisplay('users');
        foreach ($this->_responses as $response) {
            if ($this->_id === $response['id']) {
                $this->_passwordHash = $response['password'];
            } 
            if (password_verify($password, $this->_passwordHash)) {
                $this->_responsePassword = true;
            } else {
                $this->_responsePassword = false;
            }
        }
    }
}