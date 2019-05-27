<?php
require 'Data.php';
require '../modele/private/adressDataBase.php';

class User {

	private $_id;
	private $_pseudo;
	private $_email;
	private $_password;

	public function __construct($pseudo, $email, $password, $passwordConfirm) {
		$this->setPseudo($pseudo);
		$this->setEmail($email);
		$this->setPassword($password, $passwordConfirm);
	}

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
        if ($password == $passwordConfirm) {
            $this->_password = $password;
            return $this->_password;
        }
    }

    public function addDb() {
    	$newMembre = new Data($db);
    	$newMembre->add($this->_pseudo, $this->_email, $this->_password);
    }
    
}