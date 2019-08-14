<?php
namespace Model;

use Manager\ChapterManager;
use Manager\CommentManager;
use Manager\UserManager;

class CommentReports
{

    private $_id;
    private $_user;
    private $_report;

    public function __construct(array $array)
    {
        $this->hydrate($array);
    }

    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setUser($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_user = $id;
        }
    }

    public function setReports($report)
    {
        $this->_report = $report;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function getReports()
    {
        return $this->_report;
    }


    public function displayReport()
    {
        return '<p class="comment_chapter_error error_message">Signalé <span class="fa fa-flag" aria-hidden="true"></span></p>';
    }

    //Affiche les signalements et les boutons de gestion
    public function display($db)
    {
        $chapter = new ChapterManager($db);
        $user = new UserManager($db);
        $comment = new CommentManager($db);

        $title = $chapter->displayTitleAdmin(1);
        $name = $user->getName($this->getUser());
        $content = $comment->getComment($this->getId());

        $date = explode(' ', $this->getReports());
        $dateFr = explode('-', $date[0]);
        require'../View/Template/report.php';
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}