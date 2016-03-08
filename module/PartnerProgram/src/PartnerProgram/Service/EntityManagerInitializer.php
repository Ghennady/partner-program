<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 19:23
 */

namespace PartnerProgram\Service;


use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntityManagerInitializer implements InitializerInterface
{
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof EntityManagerAwareInterface) {
            $instance->setEntityManager(
                $serviceLocator->get(\Doctrine\ORM\EntityManager::class)
            );
        }

        return $instance;
    }
}