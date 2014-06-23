<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Entity\User;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\Hydrator\ObjectProperty;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $fm = $this->flashMessenger();
        if ($fm->hasMessages()) {
            var_dump($fm->getMessages());
        }

        if ($fm->hasWarningMessages()) {
            var_dump($fm->getWarningMessages());
        }
        return new ViewModel();
    }

    public function dataAction()
    {
        /* basic query */
        $db = $this->getServiceLocator()->get('db');

        /*
        $qry = $db->query('SHOW TABLES');
        $res = $qry->execute();
        foreach ($res as $data) {
            echo $data['Tables_in_schulze'], '<br>';
        }
        */

        $sql = new Sql($db);

        $select = $sql->select('user');
        $select->order('id ASC');

        $stmt = $sql->prepareStatementForSqlObject($select);
        $res = $stmt->execute();

        $hydrator = new HydratingResultSet(new ObjectProperty(), $this->getServiceLocator()->get('UserEntity'));
        $hydrator->initialize($res);

        foreach ($hydrator as $d) {
            echo 'Benutzer: ', $d->name, ' hat folgende Seiten: ';
            foreach ($d->getAllPages() as $page) {
                echo $page->title, ',';
            }
            echo '<br>';
        }

        die();
    }

    public function redirectAction()
    {
        $fm = $this->flashMessenger();
        $fm->addMessage('Hello Welt');
        $fm->addWarningMessage('Warning something goes wrong');
        $this->redirect()->toUrl('/');
    }
}
