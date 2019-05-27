<?php

class Router{
    
    private $url;

    public function __construct($url){
        $this->url = $this->recoveredUrl($url);
    }

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

            default:
                require_once '../template/accueil.php';
                break;
        } 
    }

}