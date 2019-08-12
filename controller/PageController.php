<?php

namespace controller;

use modele\Data;
use modele\Router;
use modele\CustomException;
use modele\Chapters;
use modele\ChapterManager;
use modele\CommentManager;
use modele\CommentReports;
use modele\User;

class PageController extends Data
{
    public function __construct($db, $page)
    {
        $this->page($db, $page);
        return $this->_db = $db;
    }

    //Affiche la page
    public function page($db, $page)
    {
        require_once '../View/Template/header.php';

        $this->callClass($db,$page);      
        
        require_once '../View/Template/footer.php';
    }

    //Appel Class par page
    public function callClass($db, $page)
    {
        $router = new Router($db);
        $getClean = $router->cleanArray($_GET);
        switch ($page) {
            case 'accueil':
            case 'chapitres':

                $chapterManager = new ChapterManager($db);
                break;

            case 'chapitre':
                $chapter = new ChapterManager($db);
                
                $comment = new CommentManager($db);
                break;

            case 'commentaires':
                $comment = new CommentManager($db);
                break;

            case 'administrateur':
                if(!array_key_exists('admin', $_SESSION)) {
                    header('location: accueil');
                    break;
                }
                $chapter = new ChapterManager($db);
                $title = '';
                $content = '';
                if (array_key_exists('id', $getClean)) {
                    $title = $chapter->displayTitleAdmin($getClean['id']);
                    $content = $chapter->displayContentAdmin($getClean['id']);
                }

                $reportComment = new CommentReports($db);
                break;

            case 'profil':
                $user = new User($db);
                break;
                
        }
        require_once '../View/' . $page . '.php';
    }
}