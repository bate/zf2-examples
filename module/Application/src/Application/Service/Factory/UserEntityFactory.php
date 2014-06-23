<?php
namespace Application\Service\Factory;

use Application\Entity\User;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserEntityFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $pageModel = $serviceLocator->get('Application\Model\Page');
        $user = new User();
        $user->setPageModel($pageModel);

        return $user;

    }
}
