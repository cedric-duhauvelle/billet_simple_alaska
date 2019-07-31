<?php

namespace modele;

use modele\DataRecover;

class User extends DataRecover
{
    public function __construct($db)
    {
        return $this->_db = $db;
    }
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