<?php

namespace Manager;

use PDO;
use Model\User;

class UserManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

    //SETTEUR
	public function setDb($db)
	{
		$this->_db = $db;
	}

    //Retourne les utilisateurs
    public function getUser($id)
    {
        $q = $this->_db->query('SELECT * FROM users WHERE id = '. $id);
        while ($data =  $q->fetch(PDO::FETCH_ASSOC)) {
           return $user = new User($data);
        }
    }

    //Retourne le nom
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

    //Retourne une donnee
    public function checkUserData($champ, $search, $value)
    {
        $resp = $this->_db->prepare('SELECT * FROM users');
        $resp->execute();
        $responses = $resp->fetchAll();

        foreach ($responses as $response) {
            if ($response[$champ] === $search) {
                return $response[$value];
            }
        }
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

    //Modifie le nom
    public function nameUpdate($id, $name)
	{
		$update = $this->_db->prepare('UPDATE users SET name=:name WHERE id=:id');
        $update->bindValue(':name', $name);
        $update->bindValue(':id', $id);
        $update->execute();
	}

    //Modifie l'email
	public function emailUpdate($id, $email)
	{
		$update = $this->_db->prepare('UPDATE users SET email=:email WHERE id=:id');
        $update->bindValue(':email', $email);
        $update->bindValue(':id', $id);
        $update->execute();
	}

    //Modifie le mot de passe
	public function passwordUpdate($id, $password)
	{
		$update = $this->_db->prepare('UPDATE users SET password=:password WHERE id=:id');
        $update->bindValue(':password', $password);
        $update->bindValue(':id', $id);
        $update->execute();
	}

}