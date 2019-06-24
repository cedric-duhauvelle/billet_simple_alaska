<?php
require_once 'Data.php';
require_once 'Session.php';

class DataRecover extends Data {
    
    private $_id;
    private $_passwordHash;

    //
    public function recoverData($pseudo, $password) {
        $this->nameCheck($pseudo);
        $this->passwordCheck($password);
    }

    //Verifie nom avant ajout a la base donnees
    public function nameCheck($pseudo) {
        $responseName = 0;
        $this->callDisplay('users');
        foreach ($this->_responses as $response) {
            if ($pseudo == $response['name']) {
                $this->_id = $response['id'];
                $responseName = 1;
            } elseif ('admin' == $pseudo) {
                $responseName = 2;
            }  
        }

        var_dump($responseName);

        if ($responseName === 0) {
            $session = new Session();
            $session->addSession('errorName', 'Nom incorrect');
            header('Location: connexion');
        } elseif ($responseName === 1) {
            $session = new Session();
            $session->addSession('name', $pseudo);
            $session->addSession('id_user', $this->_id);
            header('Location: profil');
        } elseif ($responseName === 2) {
            $session = new Session();
            $session->addSession('name', $pseudo);
            $session->addSession('id_user', $this->_id);
            $session->addSession('admin', $responseName);
            header('Location: administrateur');
        }
    }

    //Verifie nom avant ajout a la base donnees
    public function passwordCheck($password) {
        $responsePassword = false;

        $this->callDisplay('users');

        foreach ($this->_responses as $response) {
            
            if ($this->_id === $response['id']) {
                $this->_passwordHash = $response['password'];
            } 
            if (password_verify($password, $this->_passwordHash)) {
                $responsePassword = true;
                break;
            }    
        }
        if ($responsePassword === false) {
            $session = new Session();
            $session->addSession('errorPassword', 'Mot de passe incorrect.');
            header('location: connexion');
        } 
    }
}