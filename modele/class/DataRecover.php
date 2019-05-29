<?php

require_once 'Data.php';


class DataRecover extends Data{

	protected $_db;

	public function __construct($db) {
		return $this->_db = $db;
	}

	public function test() {
		echo $this->_db;
	}

	public function recoverDataPseudo() {
		//preparation de la requete
        $res = $this->_db->prepare('SELECT * FROM user');
        //execution de la requete
        $res->execute();
        //recuperation des donnees
        $responses = $res->fetchAll();
        //recherche dans la base de donnees
        foreach ($responses as $response) {
        	echo $response['name_user'] . '</br>';
        	echo $response['id-user'] . '</br>';
        }
    }
}