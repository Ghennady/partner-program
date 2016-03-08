<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 17:53
 */

namespace PartnerProgram\Service;

use PartnerProgram\Entity\Balance\Operation as BalanceOperationEntity;
use PartnerProgram\Service\Commission\OperationValidator;
use PartnerProgram\Service\Commission\State;

class Commission
{
    /**
     * @var Partner
     */
    private $partnerService;

    /**
     * @var State
     */
    private $commissionState;

    /**
     * @var OperationValidator
     */
    private $operationValidator;

    /**
     * @return Partner
     */
    private function getPartnerService()
    {
        return $this->partnerService;
    }

    /**
     * @param Partner $partnerService
     */
    public function setPartnerService(Partner $partnerService)
    {
        $this->partnerService = $partnerService;
    }

    /**
     * @return OperationValidator
     */
    private function getOperationValidator()
    {
        return $this->operationValidator;
    }

    /**
     * @param OperationValidator $operationValidator
     */
    public function setOperationValidator($operationValidator)
    {
        $this->operationValidator = $operationValidator;
    }

    /**
     * @return State
     */
    private function getCommissionState()
    {
        return $this->commissionState;
    }

    /**
     * @param State $commissionState
     */
    public function setCommissionState(State $commissionState)
    {
        $this->commissionState = $commissionState;
    }

    /**
     * @param BalanceOperationEntity $operation
     */
    public function pay(BalanceOperationEntity $operation)
    {
        if (!$this->getOperationValidator()->isValid($operation)) {
            return;
        }

        $partnerProgram = $this->getPartnerService()->fetchByClient($operation->getClient());
        if ($partnerProgram->hasPartnerProgram()) {
            $parentProgram = $partnerProgram->getParentPartner();
            $this->getCommissionState()->payCommission(
                $parentProgram->getClient(),
                $operation->getAmount()
            );
        }
    }
}