<?php
namespace User\Model;

use Common\Database\TecazAdapterInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserGraphTableFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return UserGraphTable
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var TecazAdapterInterface $client */
        $client = $serviceLocator->get('Common\Database\TecazNeo4JClient');
        return new UserGraphTable($client);
    }
}
