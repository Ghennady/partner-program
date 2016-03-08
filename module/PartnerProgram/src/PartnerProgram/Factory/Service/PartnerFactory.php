<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 19:26
 */

namespace PartnerProgram\Factory\Service;


use PartnerProgram\Service\Partner;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PartnerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new Partner();
        $service->setIdGenerator($serviceLocator->get('idGenerator'));
        $service->setParentPartnerIdStorage($serviceLocator->get(\PartnerProgram\Service\PartnerIdStorage::class));

        return $service;
    }
}