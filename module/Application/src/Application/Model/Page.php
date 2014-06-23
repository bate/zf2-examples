<?php
namespace Application\Model;

use Zend\Db\Sql\Sql;
use Zend\Stdlib\Exception\InvalidArgumentException;

class Page extends AbstractModel
{
    public function getAllByUserId($userId)
    {
        if (empty($userId)) {
            throw new InvalidArgumentException('UserId should be greater than 0');
        }

        $sql = new Sql($this->getDbAdapter());

        $select = $sql->select('pages');
        $select->where
               ->equalTo('userId', (int)$userId);

        $stmt = $sql->prepareStatementForSqlObject($select);
        $res = $stmt->execute();

        /*$hydrator = new HydratingResultSet(new ObjectProperty(), $this->getServiceLocator()->get('UserEntity'));
        $hydrator->initialize($res);*/

        return $res;


        echo __METHOD__;
        die();
    }
}