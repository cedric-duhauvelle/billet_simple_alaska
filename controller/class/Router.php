<?php
class Router{
    
    public function recoveredUrl($url){
            $this->checkUrl($url);
    }
    public function checkUrl($url) {
        
        $urlTest = strpos($url, '_');
        if ($urlTest) {
            $url = 'chapter';
        }
        $this->route($url);
    }

    private function route($page){
        
        switch ($page) {
            case 'connexion':
                require_once '../template/connexion.php';
                break;

            case 'inscription':
                require_once '../template/inscription.php';
                break;

            case 'deconnexion':
                require_once '../controller/deconnexionController.php';
                break;

            case 'biographie':
                require_once '../template/biographie.php';
                break;

            case 'chapitres':
                require_once '../template/chapitres.php';
                break;

            case 'chapitre':
                require_once '../template/chapitre.php';
                break;

            case 'chapter':
                require_once '../template/viewChapitre.php';
                break;

            case 'commentaires':
                require_once '../template/commentaires.php';
                break;

            case 'contact':
                require_once '../template/contact.php';
                break;

            case 'profil':
                require_once '../template/profil.php';
                break;

            case 'inscriptionProfil':
                require_once '../controller/inscriptionController.php';
                break;

            case 'administrateur':
                require_once '../template/administrator.php';
                break;

            case 'adminController':
                require_once '../controller/administratorController.php';
                break;

            case 'commentController':
                require_once '../controller/commentController.php';
                break;

            case 'connexionValidation':
                require_once '../controller/connexionController.php';
                break;

            default:
                require_once '../template/accueil.php';
                break;
        } 
    }
}