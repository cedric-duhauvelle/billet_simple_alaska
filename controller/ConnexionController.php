<?php

require_once '../modele/DataRecover.php';
require_once '../modele/Router.php';
require_once '../modele/Session.php';

$router = new Router($this->_db);
$session = new Session();
$dataCall = new DataRecover($this->_db);

$postClean = $router->cleanArray($_POST);

//Verifie et recupere un utilisateur dans la base de donnees

if ($dataCall->namecheck($postClean['pseudo']) === 0)
{
    $session->addSession('errorName', 'Nom incorrect');
    header('Location: connexion');
}
elseif ($dataCall->namecheck($postClean['pseudo']) === 1 && $dataCall->passwordCheck($postClean['pseudo'], $postClean['password']) === true)
{
	$session->addSession('name', $postClean['pseudo']);
    $session->addSession('id_user', $dataCall->returnID());
    header('Location: profil');
}
elseif ($dataCall->namecheck($postClean['pseudo']) === 2 && $dataCall->passwordCheck($postClean['pseudo'], $postClean['password']) === true)
{	
	$session->addSession('name', $postClean['pseudo']);
    $session->addSession('id_user', $dataCall->returnID());
    $session->addSession('admin', $dataCall->returnID());
    header('Location: administrateur');
}
elseif (($dataCall->namecheck($postClean['pseudo']) === 1 || $dataCall->namecheck($postClean['pseudo']) === 2) && $dataCall->passwordCheck($postClean['pseudo'], $postClean['password']) === false)
{
	$session->addSession('errorPassword', 'Mot de pase incorrect');
	header('Location: connexion');
}