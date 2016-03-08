<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 20:33
 */

namespace PartnerProgram\Factory\Service\Commission\State;


use PartnerProgram\Service\Commission\State\SecondState;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SecondStateFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new SecondState($serviceLocator->get('formulaSecondLevel'));
    }
}