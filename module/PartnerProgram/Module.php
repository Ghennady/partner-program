<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PartnerProgram;

use PartnerProgram\Entity\Balance\Reason;
use Zend\EventManager\Event;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->getSharedManager()->attach(
            \PartnerProgram\Service\Client::class,
            'register',
            function (Event $e) use ($serviceManager){
                $client = $e->getParam('client');
                /** @var \PartnerProgram\Service\Partner $partnerService */
                $partnerService = $serviceManager->get(\PartnerProgram\Service\Partner::class);
                $partnerService->createClient($client);
            }
        );
        $eventManager->getSharedManager()->attach(
            \PartnerProgram\Service\Balance\Operation::class,
            'changeBalance',
            function (Event $e) use ($serviceManager) {
                $operation = $e->getParam('operation');
                /** @var \PartnerProgram\Service\Commission $commissionService */
                $commissionService = $serviceManager->get(\PartnerProgram\Service\Commission::class);
                $commissionService->pay($operation);
            }
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
