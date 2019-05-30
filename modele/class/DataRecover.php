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
	
		$this->recoverData();

        foreach ($this->_responses as $response) {
            
        	if ($pseudo == $response['name_user']) {
        		$this->_id = $response['id-user'];
        	}
            if ($this->_id == $response['id-user']) {
                $this->_passwordHash = $response['password_user'];   
            }
            if (password_verify($password, $this->_passwordHash)) {
                $sessionStock = new Session();
                $sessionStock->addSession('name', $pseudo);
                $sessionStock->addSession('id_user', $this->_id);
                break; 
            }
        }   
    }

    private function erreurInput($text) {
        echo '<p>' . $text . '</p>';
    }
}