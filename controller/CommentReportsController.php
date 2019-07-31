<?php

namespace controller;

use modele\DataInsert;
use modele\Router;

$router = new Router($this->_db);
$postClean = $router->cleanArray($_POST);

//Ajout Signalement 
$insert = new DataInsert($this->_db);
$insert->report($postClean['id'], $_SESSION['id_user']);

//Redirection vers la page precedente
$route = explode('/',$_SERVER['HTTP_REFERER']);
header('Location: ' . $route[$router->checkServer()]);