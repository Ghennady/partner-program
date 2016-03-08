<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 8:48
 */

namespace PartnerProgram\Service;


class PartnerIdStorage
{
    /**
     * @var \Zend\Session\Container
     */
    private $sessionContainer;

    /**
     * @param \Zend\Session\Container $container
     */
    public function __construct(\Zend\Session\Container $container)
    {
        $this->sessionContainer = $container;
    }

    /**
     * @param string $partnerId
     */
    public function setPartnerId($partnerId)
    {
        $this->sessionContainer['partnerId'] = $partnerId;
    }

    /**
     * @return string
     */
    public function getPartnerId()
    {
        return $this->sessionContainer['partnerId'];
    }
}