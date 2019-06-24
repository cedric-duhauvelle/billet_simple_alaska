<?php
require_once 'Session.php';
require_once 'DataInsert.php';
require_once 'Data.php';

class User extends Data {
    private $_id;
    private $_pseudo;
    private $_email;
    private $_password;

    public function setPseudo($pseudo) {
        if (is_string($pseudo)) {
            $this->_pseudo = $pseudo;
            return $this->_pseudo;
        }
    }
    
    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->_email = $email;
            return $this->_email;
        }
    }

    //Verifie les mots de passes
    public function setPassword($password, $passwordConfirm) {
        if ($password === $passwordConfirm) {
            $this->_password = htmlspecialchars(password_hash($password, PASSWORD_DEFAULT));
            return $this->_password;
        } else {
            $sessionStock = new Session();
            $sessionStock->addSession('errorPassword', 'Les mots de passes ne sont pas identiques.');
            header('location: inscription');
        }
    } 

    //Ajoute les informations dans la base de donnees
    public function addDb() {
        $dataInsert = new DataInsert($this->_db);
        $dataInsert->add($this->_pseudo, $this->_email, $this->_password);
        header('location: profil');
    }

    //Recherche verifie et modifie le nom 
    public function checkNameUpdate($id, $name) {
        $responseName = 0;
        $this->callDisplay('users');
        foreach ($this->_responses as $response) {
            if ($name === $response['name']) {
                $responseName = 1;
            } 
        }
        if ($responseName === 0) {
            $this->updateName($id, $data);
            header('Location: profil');
        } else {
            $session = new Session();
            $session->addSession('errorName', 'Nom déjà utilisé!!');
            header('Location: updateProfil');
        }
    }

    //Recherche verifie et modifie email
    public function checkEmailUpdate($id, $email) {
        $responseEmail = 0;
        $this->callDisplay('users');
        foreach ($this->_responses as $response) {
            if ($email === $response['email']) {
                $responseEmail = 1;
            } 
        }
        if ($responseEmail === 0) {
            $this->updateEmail($id, $email);
            header('Location: profil');
        } else {
            $session = new Session();
            $session->addSession('errorEmail', 'Email déjà utilisé!!');
            header('Location: updateProfil');
        }
    }

    //Affiche le nom utilisateur
    public function displayName($id) {
        $this->callDisplay('users');
        foreach ($this->_responses as $response) {
            if ($id === $response['id']) {
                return $response['name'];
            }
        }
    }

    //Affiche email utilisateur
    public function displayEmail($id) {
        $this->callDisplay('users');
        foreach ($this->_responses as $response) {
            if ($id === $response['id']) {
                return $response['email'];
            }
        }
    }

    //Affiche la date inscription
    public function displayDateInscription($id) {
        $this->callDisplay('users');
        foreach ($this->_responses as $response) {
            if ($id === $response['id']) {
                $response['inscription'];
                $date = explode(' ', $response['inscription']);
                $dateFr = explode('-', $date[0]);
                return '<p>Inscrit depuis le ' . $dateFr[2] . '/' . $dateFr[1] . '/' . $dateFr[0] . ' à ' . $date[1] . '</p>';
            }
        }
    }

    //modifie le nom utilsateur
    public function updateName($id, $name) {
        $this->setPseudo($name);
        $update = $this->_db->prepare('UPDATE users SET name=:name WHERE id=:id');
        $update->bindValue(':name', $this->_pseudo);
        $update->bindValue(':id', $id);
        $update->execute();
        $session = new Session();
        $session->addSession('name', $this->_pseudo);
    }

    //modifie email utilsateur
    public function updateEmail($id, $email) {
        $this->setEmail($email);
        $update = $this->_db->prepare('UPDATE users SET email=:email WHERE id=:id');
        $update->bindValue(':email', $this->_email);
        $update->bindValue(':id', $id);
        $update->execute();
    }

    //modifie le mot de passe
    public function updatePassword($id, $password, $passwordCheck) {
        $this->setPassword($password, $passwordCheck);
        $update = $this->_db->prepare('UPDATE users SET password=:password WHERE id=:id');
        $update->bindValue(':password', $this->_password);
        $update->bindValue(':id', $id);
        $update->execute();
    }
}