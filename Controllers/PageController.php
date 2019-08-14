<?php

namespace Controller;

use Model\Router;
use Model\CustomException;
use Model\Chapters;
use Manager\ChapterManager;
use Manager\CommentManager;
use Manager\CommentReportsManager;
use Manager\UserManager;

class PageController
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

                if (!$chapter->checkChapterData('id', $getClean['id'], 'id')) {
                    throw new CustomException('Chapitre introuvable', 404);    
                }
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

                $report = new CommentReportsManager($db);

                break;

            case 'profil':
                $user = new UserManager($db);
                break;
                
        }
        require_once '../View/' . $page . '.php';
    }
}