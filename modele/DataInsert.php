<?php

namespace modele;

use modele\Data;

class DataInsert extends Data
{
    public function __construct($db)
    {
        return $this->_db = $db;
    }
    
    //Ajoute utilisateur a la base de donnees
    public function user($pseudo, $email, $password)
    {
        $req = $this->_db->prepare('INSERT INTO users(name, email, password) VALUES (:pseudo, :email, :password)');
        $req->bindValue(':pseudo', $pseudo);
        $req->bindValue(':email', $email);
        $req->bindValue(':password', $password);
        $req->execute();
    }
    
    
    
}

