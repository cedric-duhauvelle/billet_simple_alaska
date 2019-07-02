<?php
require_once 'DataRecover.php';
require_once 'Session.php';
require_once 'DataInsert.php';
require_once 'Data.php';

class User extends Data {
    private $_id;
    private $_pseudo;
    private $_email;
    private $_password;
    private $_responsePseudo;
    private $_responseEmail;
    private $_responsePassword;

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
    public function setPassword($password, $passwordCheck) {
        $this->_responsePassword = true;
        if ($password === $passwordCheck) {
            $this->_password = htmlspecialchars(password_hash($password, PASSWORD_DEFAULT));
            return $this->_password;
        } else {
            $this->_responsePassword = false;
        }
        return $this->_responsePassword;
    } 

    //Ajoute les informations dans la base de donnees
    public function addDb() {
        $dataInsert = new DataInsert($this->_db);
        $dataInsert->add($this->_pseudo, $this->_email, $this->_password);
        $this->searchId($this->_pseudo);
    }

    //Verifie les information utilsateur
    public function addUser($pseudo, $email, $password, $passwordCheck) {
        $this->checkName($pseudo);
        $this->checkEmail($email);
        $this->setPassword($password, $passwordCheck);
        if ($this->_responsePseudo === true) {
            $session = new Session();
            $session->addSession('errorName', 'Nom déjà utilisé');
            header('location: inscription');
        } elseif ($this->_responseEmail === true) {
            $session = new Session();
            $session->addSession('errorEmail', 'Email déjà utilisé');
            header('Location: inscription');
        } elseif ($this->_responsePassword === false) {
            $session = new Session();
            $session->addSession('errorPassword', 'Les mots de passes ne sont pas identiques');
            header('Location: inscription');
        } elseif ($this->_responsePseudo ===  false && $this->_responseEmail === false && $this->_responsePassword === true) {
            $this->setPseudo($pseudo);
            $this->setEmail($email);
            $this->setPassword($password, $passwordCheck);
            $this->addDb();
            $this->searchId($this->_pseudo);
            header('Location: profil');
        }
    }

    //Recherche id
    public function searchId($name) {
        $this->callDisplay('users');
        foreach ($this->_responses as $response) {
            if ($name === $response['name']) {
                $id = new Session();
                $id->addSession('id_user', $response['id']);
            }
        }
    }

    //Verifie et modifie nom 
    public function checkUpdateName($id, $pseudo) {
        $this->checkName($pseudo);
        if ($this->_responsePseudo === false) {
            $this->updateName($id, $pseudo);
            header('Location: profil');
        } else {
            $session = new Session();
            $session->addSession('errorName', 'Nom déjà utilisé');
            header('Location: updateProfil');
        }
    }

    //Verifie et modifie email
    public function checkEmailUpdate($id, $email) {
        $this->checkEmail($email);
        if ($this->_responseEmail === false) {
            $this->updateEmail($id, $email);
            header('Location: profil');
        } else {
            $session = new Session();
            $session->addSession('errorEmail', 'Email déjà utilisé');
            header('Location: updateProfil');
        }
    }

    //Verifie et modifie mot de passe
    public function checkPasswordUpdate($id, $password, $passwordCheck) {
        $this->setPassword($password, $passwordCheck);
        if ($this->_responsePassword === true) {
            $this->updatePassword($id);
            header('Location: profil');
        } else {
            $session = new Session();
            $session->addSession('errorPassword', 'Mots de passe différents');
            header('Location: updateProfil');
        }
    }

    //Recherche verifie nom 
    public function checkName($pseudo) {
        $this->_responsePseudo = false;
        $this->callDisplay('users');
        foreach ($this->_responses as $response) {
            if ($pseudo === $response['name']) {
                $this->_responsePseudo = true;
            } 
        }
        return $this->_responsePseudo;
    }

    //Recherche verifie email
    public function checkEmail($email) {
        $this->_responseEmail = false;
        $this->callDisplay('users');
        foreach ($this->_responses as $response) {
            if ($email === $response['email']) {
                return $this->_responseEmail = true;
            } 
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
    public function updatePassword($id) {
        $update = $this->_db->prepare('UPDATE users SET password=:password WHERE id=:id');
        $update->bindValue(':password', $this->_password);
        $update->bindValue(':id', $id);
        $update->execute();
    }
}