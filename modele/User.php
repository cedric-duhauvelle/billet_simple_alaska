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

    //modifie le nom utilsateur
    public function updateName($id, $name)
    {
        $this->setPseudo($name);
        $update = $this->_db->prepare('UPDATE users SET name=:name WHERE id=:id');
        $update->bindValue(':name', $this->_pseudo);
        $update->bindValue(':id', $id);
        $update->execute();
        $session = new Session();
        $session->addSession('name', $this->_pseudo);
    }

    //modifie email utilsateur
    public function updateEmail($id, $email)
    {
        $this->setEmail($email);
        $update = $this->_db->prepare('UPDATE users SET email=:email WHERE id=:id');
        $update->bindValue(':email', $this->_email);
        $update->bindValue(':id', $id);
        $update->execute();
    }

    //modifie le mot de passe
    public function updatePassword($id)
    {
        $update = $this->_db->prepare('UPDATE users SET password=:password WHERE id=:id');
        $update->bindValue(':password', $this->_password);
        $update->bindValue(':id', $id);
        $update->execute();
    }
}