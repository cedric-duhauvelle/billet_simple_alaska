<?php
require 'modele/private/adressDataBase.php';
class Data{

    private $_db;

    public function __construct($db) {

        $this->setDb($db);
    }
    
    public function setDb(PDO $db) {
        $this->_db = $db;
    }
    public function add($pseudo, $email, $password) {
        $req = $this->_db->prepare('INSERT INTO membres(pseudo, password, email, date_inscription) VALUES(:pseudo, :password, :email, CURDATE())');
        $req->execute(array(
            'pseudo' => $pseudo,
            'password' => $password,
            'email' => $email));

    }

}