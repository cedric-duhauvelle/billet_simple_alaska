<?php

namespace modele;

use modele\Data;

class DataRecover extends Data
{
    public function __construct($db)
    {
        return $this->_db = $db;
    }

    public function recover($tab, $champ, $search, $value)
    {
        $this->callDisplay($tab);
        foreach ($this->_responses as $response)
        {
            if ($response[$champ] === $search)
            {
                return $response[$value];
            } 
        }
    }

    //Appel a la base de donnees
    public function callDisplay($table) {
        $resp = $this->_db->prepare('SELECT * FROM ' . $table);
        $resp->execute();
        $this->_responses = $resp->fetchAll();

        return $this->_responses;
    }  
}