<?php

namespace Application\Entity;

use Application\Model\Page as PageModel;
use Zend\Stdlib\Exception\InvalidArgumentException;

class User
{
    public $id;
    public $name;
    public $email;
    public $password;

    private $pageModel;


    public function setPageModel(PageModel $model)
    {
        $this->pageModel = $model;
    }

    public function getAllPages()
    {
        if (!$this->pageModel) {
            throw new InvalidArgumentException('missing page model');
        }
        return $this->pageModel->getAllByUserId($this->id);
    }
}