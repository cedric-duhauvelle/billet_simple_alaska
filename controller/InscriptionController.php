<?php

namespace Controller;

use Model\Router;
use Model\Session;
use Manager\UserManager;

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
        $user = new UserManager($db);
        $session = new Session();

        //Nettoye la variable '$_POST'
        $postClean = $router->cleanArray($_POST);

        //Verifie si le nom est deja utilise
        if ($user->checkUserData('name', $postClean['pseudoInscription'], 'id') === null)  {
            //verifie si l'email est deja utilise
            if ($user->checkUserData('email', $postClean['emailInscription'], 'email') === null) {
                if ($postClean['passwordInscription'] === $postClean['confirmationPasswordInscription']) {
                    //Ajoute utilisateur a la base de donnees  
                    $user->add($postClean['pseudoInscription'], $postClean['emailInscription'], password_hash($postClean['passwordInscription'], PASSWORD_DEFAULT));
                    $session->addSession('id_user', $user->checkUserData('name', $postClean['pseudoInscription'], 'id'));
                    $session->addSession('name', $postClean['pseudoInscription']);
                    return header('Location: profil');
                } else {
                    $session->addSession('errorPassword', 'Les mots de passe ne sont pas identiques');
                }
            } else {
                $session->addSession('errorEmail', 'Email déjà utilisée!!');
            }
        } else {
            $session->addSession('errorName', 'Nom déjà utilisé!!');
        }
        header('Location: inscription');
    }
}