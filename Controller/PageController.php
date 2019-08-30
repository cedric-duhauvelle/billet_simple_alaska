<?php

namespace Controller;

use Model\Router;
use Model\CustomException;
use Model\Chapters;
use Model\Comment;
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
            $chapterManager = new ChapterManager($db);
            $userManager = new UserManager($db);
            $commentManager = new CommentManager($db);
            $commentReportsManager =  new CommentReportsManager($db);
            if ('accueil' === $page) {
                $chapters = $chapterManager->getLastChapters();
            } elseif ('chapitres' === $page) {
                $chapters = $chapterManager->getChapters();
            } elseif ('chapitre' === $page) {
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
                $chapters = $chapterManager->getChapters();
                $reports = $commentReportsManager->getReports();
                $title = '';
                $content = '';
                if (array_key_exists('id', $getClean)) {
                    $chapter = $chapterManager->getChapter($getClean['id']);
                    $title = $chapter->getTitle();
                    $content = $chapter->getContent();
                }
            } elseif ('commentaires' === $page) {
                $chapter = $chapterManager->getChapters();
                $comments = $commentManager->getComments();
                $reports = $commentReportsManager->getReports();
            } elseif ('profil' === $page) {
                $user = $userManager->getUser($_SESSION['id_user']);
            }
            require_once '../View/' . $page . '.php';
        } else {
            throw new CustomException("Page introuvable", 404);
        }
    }
}