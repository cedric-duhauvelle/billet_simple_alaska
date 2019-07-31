<?php

require_once 'DataRecover.php';
require_once 'Session.php';
require_once 'DataInsert.php';

class User extends DataRecover
{
    public function displayName($id)
    {
        return $this->recover('users', 'id', $id, 'name');
    }

    public function displayEmail($id)
    {
        return $this->recover('users', 'id', $id, 'email');
    }

    //Affiche la date inscription
    public function displayDateInscription($id)
    {
        $date = $this->recover('users', 'id', $id, 'inscription');
        $dateArray = explode(' ', $date);
        $dateFr = explode('-', $dateArray[0]);

        return '<p>Inscrit depuis le ' . $dateFr[2] . '/' . $dateFr[1] . '/' . $dateFr[0] . ' à ' . $dateArray[1] . '</p>';
    }
}