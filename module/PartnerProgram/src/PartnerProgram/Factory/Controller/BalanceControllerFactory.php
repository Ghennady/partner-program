<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 9:25
 */

namespace PartnerProgram\Factory\Controller;


use PartnerProgram\Controller\BalanceController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BalanceControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $controller = new BalanceController();
        $sm = $serviceLocator->getServiceLocator();

        $controller->setBalanceForm($sm->get('formBalance'));
        $controller->setClientService($sm->get(\PartnerProgram\Service\Client::class));
        $controller->setBalanceOperationService($sm->get(\PartnerProgram\Service\Balance\Operation::class));

        return $controller;
    }
}