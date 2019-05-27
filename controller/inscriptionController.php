<?php

require '../modele/class/User.php';

$user = new User($_POST['pseudoInscription'], $_POST['emailInscription'], $_POST['passwordInscription'], $_POST['confirmationPasswordInscription']);

$user->addDb();