<?php

require_once '../modele/DataRecover.php';
require_once '../modele/Router.php';
require_once '../modele/Session.php';

$routeur = new Router($this->_db);
$check = new DataRecover($this->_db);
$session = new Session();

$postClean = $routeur->cleanArray($_POST);

if ($check->recover('users', 'name', $postClean['pseudo'], 'id') === null)
{
    $session->addSession('errorName', 'Nom incorrect!!');
    header('Location: connexion');
}
else
{
    if (password_verify($postClean['password'], $check->recover('users', 'name', $postClean['pseudo'], 'password')))
    {
        if (array_key_exists('admin', $_SESSION))
        {
            session_destroy();
        }
        $session->addSession('id_user', $check->recover('users', 'name', $postClean['pseudo'], 'id'));
        $session->addSession('name', $postClean['pseudo']);
        if ('admin' === $postClean['pseudo'])
        {
            $session->addSession('admin', 'admistrateur');
        }
        header('Location: profil');
    }
    else
    {
        $session->addSession('errorPassword', 'Mot de passe incorrect!!');
        header('Location: connexion');
    }
}