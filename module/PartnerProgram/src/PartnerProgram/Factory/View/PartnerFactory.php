<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 19:41
 */

namespace PartnerProgram\Factory\View;


use PartnerProgram\View\Partner;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PartnerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $viewHelper = new Partner();
        $viewHelper->setPartnerService($serviceLocator->getServiceLocator()->get(\PartnerProgram\Service\Partner::class));

        return $viewHelper;
    }
}