<?php

require_once '../modele/Router.php';
require_once '../modele/DataRecover.php';
require_once '../modele/DataInsert.php';
require_once '../modele/Session.php';

$router = new Router($this->_db);
$check = new DataRecover($this->_db);
$insert = new DataInsert($this->_db);
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
            var_dump($check->recover('users', 'name', $postClean['pseudoInscription'], 'id'));
            var_dump($_SESSION);
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