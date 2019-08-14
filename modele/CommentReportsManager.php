<?php

namespace modele;

use modele\CommentReports;

class CommentReportsManager
{

	private $_db;

	public function __construct($db)
	{
		$this->setdb($db);
	}

	public function setDb($db)
	{
		$this->_db = $db;
	}

	//Ajoute un signalement a la base de donnees
    public function add($idComment, $idUser)
    {
        $req = $this->_db->prepare('INSERT INTO reporting(id, user) VALUES (:id, :user)');
        $req->bindValue(':id', $idComment);
        $req->bindValue(':user', $idUser);
        $req->execute();   
    }

    public function getReports()
    {
        $reports = [];
        $q = $this->_db->query('SELECT * FROM reporting');
        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $report = new CommentReports($data);
            $reports[] = $report->display($this->_db);
        }

        return $reports;
    }

    public function getIdReport($id)
    {
        $resp = $this->_db->prepare('SELECT * FROM reporting');
        $resp->execute();
        $responses = $resp->fetchAll();

        foreach ($responses as $response) {
            if ($response['id'] == $id) {
                return true;
            }  
        }
        return false;   
    }

    //Recherche une Donnee dans la base de donnees
    public function recover($tab, $champ, $search, $value)
    {
        $this->callDisplay($tab);
        
    }

    public function getReport($id)
    {
        $id = (int) $id;
        $reports = [];
        $q = $this->_db->query('SELECT * FROM comments WHERE id = '. $id);
        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $report = new CommentReports($data);
            $reports[] = $report->displayReport();
        }

        return $reports;
    }


    public function delete($id)
	{
		$req = $this->_db->prepare('DELETE FROM reporting WHERE id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
	}
}