<?php

namespace Controller;

use Model\Router;
use Model\Session;
use Manager\UserManager;

class ConnexionController
{
    public function __construct($db)
    {
        $this->checkUser($db);
    }

    //Verifie les informations utilsateur pour la connexion
    public function checkUser($db)
    {
        $routeur = new Router($db);
        $user = new UserManager($db);
        $session = new Session();

        //Nettoye la variable '$_POST'
        $postClean = $routeur->cleanArray($_POST);

        //Verifie le nom 
        if ($user->checkUserData('name', $postClean['pseudo'], 'id') === null) {
            $session->addSession('errorName', 'Nom incorrect!!');
        } else {
            //verifie le password
            if (password_verify($postClean['password'], $user->checkUserData('name', $postClean['pseudo'], 'password'))) {
                if (array_key_exists('admin', $_SESSION)) {
                    session_destroy();
                }
                $session->addSession('id_user', $user->checkUserData('name', $postClean['pseudo'], 'id'));
                $session->addSession('name', $postClean['pseudo']);
                if ('admin' === $postClean['pseudo']) {
                    $session->addSession('admin', 'admistrateur');
                }
                return header('Location: profil');
            } else {
                $session->addSession('errorPassword', 'Mot de passe incorrect!!');   
            }
        }
        header('Location: connexion');  
    }
}