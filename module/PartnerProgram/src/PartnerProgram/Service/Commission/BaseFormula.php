<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 19:46
 */

namespace PartnerProgram\Service\Commission;


class BaseFormula implements FormulaInterface
{
    /**
     * @param float $amount
     * @return float
     */
    public function evaluate($amount)
    {
        return $amount * 0.1;
    }
}