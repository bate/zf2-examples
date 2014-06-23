<?php
namespace Application\Model;

abstract class AbstractModel
{
    private $db;

    public function setDbAdapter($db)
    {
        $this->db = $db;
        return $this;
    }

    public function getDbAdapter()
    {
        return $this->db;
    }
}