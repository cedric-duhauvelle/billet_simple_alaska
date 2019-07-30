<?php

require_once 'Data.php';
require_once 'Session.php';

class DataRecover extends Data {
    
    private $_id;
    private $_passwordHash;
    private $_responseName;
    private $_responsePassword;

    public function returnID(){
        return $this->_id;
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
    public function passwordCheck($pseudo, $password) {
        $this->nameCheck($pseudo);
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

        return $this->_responsePassword;
    }
}