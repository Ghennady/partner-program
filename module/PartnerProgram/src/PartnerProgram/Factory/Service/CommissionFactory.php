<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 18:03
 */

namespace PartnerProgram\Factory\Service;


use PartnerProgram\Service\Commission;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CommissionFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new Commission();
        $service->setCommissionState($serviceLocator->get(\PartnerProgram\Service\Commission\State::class));
        $service->setPartnerService($serviceLocator->get(\PartnerProgram\Service\Partner::class));
        $service->setOperationValidator($serviceLocator->get(\PartnerProgram\Service\Commission\OperationValidator::class));

        return $service;

    }
}