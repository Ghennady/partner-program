<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 21:13
 */

namespace PartnerProgram\Service\Commission;


use PartnerProgram\Entity\Balance\Operation;

class OperationValidator
{
    /**
     * @param Operation $operation
     * @return bool
     */
    public function isValid(Operation $operation)
    {
        $reason = $operation->getReason();
        return $reason->isRefill() || $reason->isCommission();
    }
}