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

            if ($page === 'accueil' || 'chapitres' || 'chapitre' || 'administrateur') {

                $chapterManager = new ChapterManager($db);
                if ($page === 'chapitre') {
                    $commentManager = new CommentManager($db);
                    $commentReportsManager =  new CommentReportsManager($db);
                    $userManager = new UserManager($db);

                    $comments = $commentManager->getCommentChapter($getClean['id']);
                    $chapter = $chapterManager->getChapter($getClean['id']);
                    $reports = $commentReportsManager->getReports();

                    if (!$chapterManager->checkChapterData('id', $getClean['id'], 'id')) {

                        throw new CustomException("Chapitre introuvable", 404);    
                    }
                } elseif ($page === 'administrateur') {
                    if(!array_key_exists('admin', $_SESSION)) {

                        return header('location: accueil');
                    }
                    $title = '';
                    $content = '';
                    if (array_key_exists('id', $getClean)) {

                        $title = $chapter->displayTitleAdmin($getClean['id']);
                        $content = $chapter->displayContentAdmin($getClean['id']);
                    }
                    $report = new CommentReportsManager($db);
                }
            }
            if ($page === 'commentaires') {

                $comment = new CommentManager($db);
            }
            if ($page === 'profil') {

                $user = new UserManager($db);
            }
            require_once '../View/' . $page . '.php';
             
        } else {
            throw new CustomException("Page introuvable", 404);
        }
    }
}