<?php

namespace controller;

use modele\Data;
use modele\Router;
use modele\CustomException;
use modele\Chapters;
use modele\Comment;
use modele\CommentReports;
use modele\User;

class PageController extends Data
{
    public function __construct($db, $page)
    {
        $this->page($db, $page);
        return $this->_db = $db;
    }

    public function page($db, $page)
    {
        require_once '../View/Template/header.php';

        $this->callClass($db,$page);      
        
        require_once '../View/Template/footer.php';
    }

    public function callClass($db, $page)
    {
        switch ($page) {
            case 'accueil':
                $chapter = new Chapters($db);
                break;
            case 'chapitres':
                $chapters = new Chapters($db);
                break;
            case 'chapitre':
                $chapter = new Chapters($db);
                $comment = new Comment($db);
                break;
            case 'commentaires':
                $comment = new Comment($db);
                break;
            case 'administrateur':
                if(!array_key_exists('admin', $_SESSION)) {
                    header('location: accueil');
                    break;
                }
                $chapter = new Chapters($db);
                $reportComment = new CommentReports($db);
                break;
            case 'profil':
                $user = new User($db);
                break;
        }
        require_once '../View/' . $page . '.php';
    }
}