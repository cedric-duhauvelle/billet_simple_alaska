<?php

namespace Model;

class User
{
    private $_id;
    private $_name;
    private $_email;
    private $_password;
    private $_inscription;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    //SETTEUR
    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setName($name)
    {
        if (is_string($name)) {
            $this->_name = $name;
        }
    }

    public function setEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->_email = $email;
        }
    }

    public function setPassword($password)
    {
        if (is_string($password)) {
            $this->_password = $password;
        }
    }

    public function setInscription($inscription)
    {
        $this->_inscription = $inscription;
    }

    //GETTEUR
    public function getId()
    {
        return $this->_id;
    }

    public function getName()
    {
        return $this->_name;
    }
    
    public function getEmail()
    {
        return $this->_email;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function getInscription()
    {
        return $this->_inscription;
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}