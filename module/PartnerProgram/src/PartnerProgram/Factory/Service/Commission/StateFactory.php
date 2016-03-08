<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 20:42
 */

namespace PartnerProgram\Factory\Service\Commission;


use PartnerProgram\Service\Commission\State;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class StateFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $state = new State($serviceLocator->get(\PartnerProgram\Service\Commission\State\FirstState::class));
        $state->setBalanceOperation($serviceLocator->get(\PartnerProgram\Service\Balance\Operation::class));

        return $state;
    }
}