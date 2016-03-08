<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 20:38
 */

namespace PartnerProgram\Factory\Service\Commission\State;


use PartnerProgram\Service\Commission\State\FirstState;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FirstStateFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new FirstState(
            $serviceLocator->get('formulaFirstLevel'),
            $serviceLocator->get(\PartnerProgram\Service\Commission\State\SecondState::class)
        );
    }

}