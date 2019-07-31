<?php

require_once 'Data.php';
require_once 'Session.php';

class DataInsert extends Data
{

    //Ajoute le nom a la session
    private function addSession($data)
    {
        $session = new Session();
        $session->addSession('name', $data);
    }

    //Ajoute utilisateur a la base de donnees
    public function user($pseudo, $email, $password)
    {
        $req = $this->_db->prepare('INSERT INTO users(name, email, password) VALUES (:pseudo, :email, :password)');
        $req->bindValue(':pseudo', $pseudo);
        $req->bindValue(':email', $email);
        $req->bindValue(':password', $password);
        $req->execute();
        $this->addSession($pseudo);
    }
    public function comment($id, $comment, $idChapter)
    {
        $req = $this->_db->prepare('INSERT INTO comments(user, content, chapter) VALUES (:user, :comment, :chapter)');
        $req->bindValue(':user', $id);
        $req->bindValue(':comment', $comment);
        $req->bindValue(':chapter', $idChapter);
        $req->execute();
    }
}

