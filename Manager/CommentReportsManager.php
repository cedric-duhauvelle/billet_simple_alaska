<?php

namespace Manager;

use PDO;
use Model\CommentReports;
use Manager\ChapterManager;
use Manager\CommentManager;
use Manager\UserManager;

class CommentReportsManager
{

	private $_db;

	public function __construct($db)
	{
		$this->setdb($db);
	}

    //SETTEUR
	public function setDb($db)
	{
		$this->_db = $db;
	}

	//Ajoute un report a la base de donnees
    public function add($idComment, $idUser)
    {
        $req = $this->_db->prepare('INSERT INTO reporting(id, user) VALUES (:id, :user)');
        $req->bindValue(':id', $idComment);
        $req->bindValue(':user', $idUser);
        $req->execute();   
    }

    //Retourne les reports (Admin)
    public function getReports()
    {
        $reports = [];
        $q = $this->_db->query('SELECT * FROM reporting');
        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $reports[] = new CommentReports($data);
        }

        return $reports;
    }

    //Retourne 'true' si le commentaire a ete signaler
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

    //Retourne les reports 
    public function getReport($id)
    {
        $id = (int) $id;
        $reports = [];
        $q = $this->_db->query('SELECT * FROM comments WHERE id = '. $id);
        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $reports[] = new CommentReports($data);
        }

        return $reports;
    }

    //Efface un report
    public function delete($id)
	{
		$req = $this->_db->prepare('DELETE FROM reporting WHERE id=:id LIMIT 1');
        $req->bindValue(':id', $id);
        $req->execute();
	}

    //Affiche un report sur un commentaire
    public function displayReport()
    {
        return '<p class="comment_chapter_error error_message">Signalé <span class="fa fa-flag" aria-hidden="true"></span></p>';
    }

    //Affiche les signalements et les boutons de gestion
    public function display($data)
    {
        $report = new CommentReports($data);
        $chapter = new ChapterManager($this->_db);
        $user = new UserManager($this->_db);
        $comment = new CommentManager($this->_db);
        
        $idComment = $report->getId();
        $title = $chapter->displayTitleAdmin($comment->checkCommentData($idComment));
        $name = $user->getName($report->getUser());
        $content = $comment->getComment($report->getId());

        $date = explode(' ', $report->getReports());
        $dateFr = explode('-', $date[0]);
        require'../View/Template/report.php';
    }
}