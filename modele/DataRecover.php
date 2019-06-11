<?php
require_once 'Data.php';
require_once 'Session.php';
class DataRecover extends Data{
    
    protected $_db;
    private $_responses;
    private $_id;
    private $_passwordHash;

    public function __construct($db) {
        return $this->_db = $db;
    }

    public function test() {
        echo $this->_db;
    }

    private function recoverData() {
        //preparation de la requete
        $res = $this->_db->prepare('SELECT * FROM user');
        //execution de la requete
        $res->execute();
        //recuperation des donnees
        $this->_responses = $res->fetchAll();
        return $this->_responses;
    }

    public function dataCheck($pseudo, $password) {

        $responseName = 0;
        $responsePassword = false;

        $this->recoverData();

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
        if ($responseName === 2 AND $responsePassword === true){
            $sessionStock = new Session();
            $sessionStock->addSession('name', $pseudo);
            $sessionStock->addSession('id_user', $this->_id);
            $sessionStock->addSession('admin', 2);
            header('location: ../public/administrateur');
            
        } elseif ($responseName === 1 AND $responsePassword === true) {
            $sessionStock = new Session();
            $sessionStock->addSession('name', $pseudo);
            $sessionStock->addSession('id_user', $this->_id);
            header('location: ../public/profil');

        } elseif ($responseName === 0) {            
            $session = new Session();
            $session->addSession('errorName', 'Le nom que vous avez tentez d\'utilser n\'est pas validé.');
            header('location: ../public/connexion');

        } elseif ($responsePassword === false) {
            $session = new Session();
            $session->addSession('errorPassword', 'Mot de passe incorrect.');
            header('location: ../public/connexion');
        } 
    }
}