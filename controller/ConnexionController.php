<?php

namespace controller;

use modele\DataRecover;
use modele\Router;
use modele\Session;

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
        $check = new DataRecover($db);
        $session = new Session();

        //Nettoye la variable '$_POST'
        $postClean = $routeur->cleanArray($_POST);

        //Verifie le nom 
        if ($check->recover('users', 'name', $postClean['pseudo'], 'id') === null) {
            $session->addSession('errorName', 'Nom incorrect!!');
            header('Location: connexion');
        } else {
            //verifie le password
            if (password_verify($postClean['password'], $check->recover('users', 'name', $postClean['pseudo'], 'password'))) {
                if (array_key_exists('admin', $_SESSION)) {
                    session_destroy();
                }
                $session->addSession('id_user', $check->recover('users', 'name', $postClean['pseudo'], 'id'));
                $session->addSession('name', $postClean['pseudo']);
                if ('admin' === $postClean['pseudo']) {
                    $session->addSession('admin', 'admistrateur');
                }
                header('Location: profil');
            } else {
                $session->addSession('errorPassword', 'Mot de passe incorrect!!');
                header('Location: connexion');
            }
        } 
    }
}