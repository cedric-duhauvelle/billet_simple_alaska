<?php

namespace modele;

use modele\Data;

class DataUpdate extends Data
{
	public function __construct($db)
    {
        return $this->_db = $db;
    }
	
	
}