<?php

require_once 'Data.php';

class DataInsert extends Data {

	protected $_db;

	public function __construct($db) {
		return $this->_db = $db;
	}

	public function add($pseudo, $email, $password) {
        $req = $this->_db->prepare('INSERT INTO user(name_user, email_user, password_user, date_inscription) VALUES (:pseudo, :email, :password, CURDATE())');

        $req->bindvalue(':pseudo', $pseudo);
        $req->bindValue(':email', $email);
        $req->bindValue(':password', $password);

        $req->execute();
    }
}
