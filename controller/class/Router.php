<?php
class Router{
    
    private function recoveredUrl($url){
        if(isset($_GET['url'])){
            $url = explode('/', $_GET['url']);
        }
    }
    public function road($page){
        
        switch ($page) {
            case 'connexion':
                require_once '../template/connexion.php';
                break;
            case 'inscription':
                require_once '../template/inscription.php';
                break;
            case 'biographie':
                require_once '../template/biographie.php';
                break;
            case 'chapitres':
                require_once '../template/chapitres.php';
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
            case 'connexionValidation':
                require_once '../controller/connexionController.php';
                break;
            default:
                require_once '../template/accueil.php';
                break;
        } 
    }
}