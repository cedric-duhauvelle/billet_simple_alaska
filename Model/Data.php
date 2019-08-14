<?php

namespace modele;

class Data
{
    protected $_db;
    protected $_responses;

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }
    
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    } 
}