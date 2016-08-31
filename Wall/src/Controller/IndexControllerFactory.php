<?php
namespace Wall\Controller;

use User\Model\UserGraphTable;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $serviceLocator->getServiceLocator();
        /** @var UserGraphTable $userGraphTable */
        $userGraphTable = $serviceManager->get('Tecaz.UserGraphTable');
        return new IndexController($userGraphTable);
    }
}