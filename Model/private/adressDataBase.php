<?php

namespace Model;

use PDO;
use modele\CustomException;

try {
	$db = new PDO('mysql:host=localhost;dbname=billet_alaska;charset=utf8', 'Cedric', 'Billetalaska0&');
} catch (CustomException $e) {
    die('Erreur : ' . $e->getMessage());
}