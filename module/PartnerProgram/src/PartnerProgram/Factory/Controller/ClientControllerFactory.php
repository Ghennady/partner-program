<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 16:58
 */

namespace PartnerProgram\Factory\Controller;


use PartnerProgram\Controller\ClientController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ClientControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $controller = new ClientController();
        $sm = $serviceLocator->getServiceLocator();

        $controller->setFormRegister($sm->get('formRegister'));
        $controller->setClientService($sm->get(\PartnerProgram\Service\Client::class));
        $controller->setPartnerIdStorage($sm->get(\PartnerProgram\Service\PartnerIdStorage::class));

        return $controller;
    }
}