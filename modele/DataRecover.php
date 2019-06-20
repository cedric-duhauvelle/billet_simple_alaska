<?php
require_once 'Data.php';
require_once 'Session.php';

class DataRecover extends Data {
    
    private $_id;
    private $_passwordHash;

    //Verifie les informations de utilsateur avant ajout a la base donnees
    public function dataCheck($pseudo, $password) {
        $responseName = 0;
        $responsePassword = false;

        $this->callDisplay('user');

        foreach ($this->_responses as $response) {
            
            if ($pseudo === $response['name_user']) {
                $this->_id = $response['id-user'];
                $responseName = 1;
            } 
            if ('admin' === $response['name_user']) {
                $responseName = 2;
            }
            if ($this->_id === $response['id-user']) {
                $this->_passwordHash = $response['password_user'];
            } 
            if (password_verify($password, $this->_passwordHash)) {
                $responsePassword = true;
                break;
            }    
        }
        if ($responseName === 2 AND $responsePassword === true) {
            $sessionStock = new Session();
            $sessionStock->addSession('name', $pseudo);
            $sessionStock->addSession('id_user', $this->_id);
            $sessionStock->addSession('admin', 2);
            header('location: administrateur');   
        } elseif ($responseName === 1 AND $responsePassword === true) {
            $sessionStock = new Session();
            $sessionStock->addSession('name', $pseudo);
            $sessionStock->addSession('id_user', $this->_id);
            header('location: profil');
        } elseif ($responseName === 0) {            
            $session = new Session();
            $session->addSession('errorName', 'Le nom que vous avez tentez d\'utilser n\'est pas validé.');
            header('location: connexion');
        } elseif ($responsePassword === false) {
            $session = new Session();
            $session->addSession('errorPassword', 'Mot de passe incorrect.');
            header('location: connexion');
        } 
    }
}