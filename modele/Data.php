<?php

class Data {

    protected $_db;

    public function __construct(PDO $db) {
        $this->setDb($db);
    }
    
    public function setDb(PDO $db) {
        $this->_db = $db;
    }   
}