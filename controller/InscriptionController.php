<?php

namespace controller;

use modele\Router;
use modele\DataRecover;
use modele\DataInsert;
use modele\Session;

class InscriptionController
{
    public function __construct($db)
    {
        $this->inscription($db);
    }

    public function inscription($db)
    {
        $router = new Router($db);
        $check = new DataRecover($db);
        $insert = new DataInsert($db);
        $session = new Session();

        $postClean = $router->cleanArray($_POST);

        if ($check->recover('users', 'name', $postClean['pseudoInscription'], 'id') === null)
        {
            if ($check->recover('users', 'email', $postClean['emailInscription'], 'email') === null)
            {
                if ($postClean['passwordInscription'] === $postClean['confirmationPasswordInscription'])
                {   
                    $insert->user($postClean['pseudoInscription'], $postClean['emailInscription'], password_hash($postClean['passwordInscription'], PASSWORD_DEFAULT));
                    $session->addSession('id_user', $check->recover('users', 'name', $postClean['pseudoInscription'], 'id'));
                    $session->addSession('name', $postClean['pseudoInscription']);
                    header('Location: profil');
                }
                else
                {
                    $session->addSession('errorPassword', 'Les mots de passe ne sont pas identiques');
                    header('Location: inscription');
                }
            }
            else
            {
                $session->addSession('errorEmail', 'Email déjà utilisée!!');
                header('Location: inscription');
            }
        }
        else
        {
            $session->addSession('errorName', 'Nom déjà utilisé!!');
            header('Location: inscription');
        }
    }
}