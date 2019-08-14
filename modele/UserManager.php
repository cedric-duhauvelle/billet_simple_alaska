<?php

namespace modele;

use modele\User;

class UserManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb($db)
	{
		$this->_db = $db;
	}

	//retourne un chapitre
    public function getInscription($id)
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT * FROM users WHERE id = '.$id); 
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $user = new User($data);

        return $user->displayInscription();      
    }

    //Recherche le nom
    public function getName($id)
    {
        $id = (int) $id;        
        $q = $this->_db->query('SELECT * FROM users WHERE id = '. $id);
        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $user = new User($data);
            return $user->getName();
        } 
    }  

    //Recherche Email
    public function getEmail($id)
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT * FROM users WHERE id = '.$id); 
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $user = new User($data);

        return $user->getEmail();      
    }

    public function getPassword($id)
    {
    	$id = (int) $id;
        $q = $this->_db->query('SELECT * FROM users WHERE id = '.$id); 
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $user = new User($data);

        return $user->getPassword(); 
    }

    //Ajoute utilisateur a la base de donnees
    public function add($pseudo, $email, $password)
    {
        $req = $this->_db->prepare('INSERT INTO users(name, email, password) VALUES (:pseudo, :email, :password)');
        $req->bindValue(':pseudo', $pseudo);
        $req->bindValue(':email', $email);
        $req->bindValue(':password', $password);
        $req->execute();
    }

    public function nameUpdate($id, $name)
	{
		$update = $this->_db->prepare('UPDATE users SET name=:name WHERE id=:id');
        $update->bindValue(':name', $name);
        $update->bindValue(':id', $id);
        $update->execute();
	}

	public function emailUpdate($id, $email)
	{
		$update = $this->_db->prepare('UPDATE users SET email=:email WHERE id=:id');
        $update->bindValue(':email', $email);
        $update->bindValue(':id', $id);
        $update->execute();
	}

	public function passwordUpdate($id, $password)
	{
		$update = $this->_db->prepare('UPDATE users SET password=:password WHERE id=:id');
        $update->bindValue(':password', $password);
        $update->bindValue(':id', $id);
        $update->execute();
	}

}