<?php
require_once 'DataInsert.php';
require_once 'DataRecover.php';

class User extends DataRecover {
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

    public function addDb($db) {
        $dataInsert = new DataInsert($db);
        $dataInsert->add($this->_pseudo, $this->_email, $this->_password);
        header('location: profil');
    }

    public function displayUser($id) {
        $this->recoverData();
        foreach ($this->_responses as $response) {
            if ($id === $response['id-user']) {
                echo '<div class="profil_user_content">';
                echo '<p class="user_name">' . ucwords($response['name_user']) . '</p>';
                echo '<p>' . $response['email_user'] . '</p>';
                $date = explode(' ', $response['date_inscription']);
                $dateFr = explode('-', $date[0]);
                echo '<p>Inscrit depuis le ' . $dateFr[2] . '/' . $dateFr[1] . '/' . $dateFr[0] . '</p>';
                echo '</div>';
            }
        }
    }
}