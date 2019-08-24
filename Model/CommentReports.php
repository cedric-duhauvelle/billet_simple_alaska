<?php
namespace Model;

class CommentReports
{
    private $_id;
    private $_user;
    private $_report;

    public function __construct(array $array)
    {
        $this->hydrate($array);
    }

    //SETTEUR
    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setUser($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_user = $id;
        }
    }

    public function setReports($report)
    {
        $this->_report = $report;
    }

    //GETTEUR
    public function getId()
    {
        return $this->_id;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function getReports()
    {
        return $this->_report;
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