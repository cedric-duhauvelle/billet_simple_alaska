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

        if (is_file('../View/' . $page . '.php')) {

            if ($page === 'accueil' || 'chapitres' || 'chapitre' || 'administrateur' || 'commentaires') {

                $chapterManager = new ChapterManager($db);
                $userManager = new UserManager($db);
                $commentReportsManager =  new CommentReportsManager($db);
                if ('accueil' === $page) {
                    $chapters = $chapterManager->getLastChapters();
                } elseif ('chapitres' === $page) {
                    $chapters = $chapterManager->getChapters();
                } elseif ('chapitre' === $page) {
                    $commentManager = new CommentManager($db);
                    

                    $chapters = $chapterManager->getChapters();
                    $comments = $commentManager->getCommentChapter($getClean['id']);
                    $chapter = $chapterManager->getChapter($getClean['id']);
                    $reports = $commentReportsManager->getReports();

                    if (!$chapterManager->checkChapterData('id', $getClean['id'], 'id')) {

                        throw new CustomException("Chapitre introuvable", 404);    
                    }
                } elseif ('administrateur' === $page) {
                    if(!array_key_exists('admin', $_SESSION)) {

                        return header('location: accueil');
                    }
                    $title = '';
                    $content = '';
                    if (array_key_exists('id', $getClean)) {

                        $title = $chapterManager->displayTitleAdmin($getClean['id']);
                        $content = $chapterManager->displayContentAdmin($getClean['id']);
                    }
                    $report = new CommentReportsManager($db);
                } elseif ('commentaires' === $page) {
                    $commentManager = new CommentManager($db);

                    $chapter = $chapterManager->getChapters();
                    $comments = $commentManager->getComments();
                    $reports = $commentReportsManager->getReports();
                }
            }
            
            if ($page === 'profil') {

                $userManager = new UserManager($db);
                $user = $userManager->getUser($_SESSION['id_user']);
            }
            require_once '../View/' . $page . '.php';
             
        } else {
            throw new CustomException("Page introuvable", 404);
        }
    }
}