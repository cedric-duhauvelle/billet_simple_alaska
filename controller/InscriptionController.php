<?php

namespace Controller;

use Model\Router;
use Model\Session;

class InscriptionController
{
    public function __construct($db)
    {
        $this->inscription($db);
    }

    //Verifie et ajoute utilisateur a la base de donnees
    public function inscription($db)
    {
        $router = new Router($db);
        $check = new DataRecover($db);
        $insert = new DataInsert($db);
        $session = new Session();

        //Nettoye la variable '$_POST'
        $postClean = $router->cleanArray($_POST);

        //Verifie si le nom est deja utilise
        if ($check->recover('users', 'name', $postClean['pseudoInscription'], 'id') === null)  {
            //verifie si l'email est deja utilise
            if ($check->recover('users', 'email', $postClean['emailInscription'], 'email') === null) {
                if ($postClean['passwordInscription'] === $postClean['confirmationPasswordInscription']) {
                    //Ajoute utilisateur a la base de donnees  
                    $insert->user($postClean['pseudoInscription'], $postClean['emailInscription'], password_hash($postClean['passwordInscription'], PASSWORD_DEFAULT));
                    $session->addSession('id_user', $check->recover('users', 'name', $postClean['pseudoInscription'], 'id'));
                    $session->addSession('name', $postClean['pseudoInscription']);
                    header('Location: profil');
                } else {
                    $session->addSession('errorPassword', 'Les mots de passe ne sont pas identiques');
                    header('Location: inscription');
                }
            } else {
                $session->addSession('errorEmail', 'Email déjà utilisée!!');
                header('Location: inscription');
            }
        } else {
            $session->addSession('errorName', 'Nom déjà utilisé!!');
            header('Location: inscription');
        }
    }
}