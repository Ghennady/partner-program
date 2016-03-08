<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 8:53
 */

namespace PartnerProgram\Factory\Service;

use PartnerProgram\Service\PartnerIdStorage;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PartnerIdStorageFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $storage = new PartnerIdStorage($serviceLocator->get(\Zend\Session\Container::class));

        return $storage;
    }
}