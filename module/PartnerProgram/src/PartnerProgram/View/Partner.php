<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 19:36
 */

namespace PartnerProgram\View;


use PartnerProgram\Entity\Client;
use PartnerProgram\Service\Partner as PartnerService;
use Zend\View\Helper\AbstractHelper;

class Partner extends AbstractHelper
{
    /**
     * @var PartnerService
     */
    private $partnerService;

    /**
     * @param PartnerService $partnerService
     */
    public function setPartnerService(PartnerService $partnerService)
    {
        $this->partnerService = $partnerService;
    }

    public function __invoke(Client $client)
    {
        return $this->partnerService->fetchByClient($client);
    }
}