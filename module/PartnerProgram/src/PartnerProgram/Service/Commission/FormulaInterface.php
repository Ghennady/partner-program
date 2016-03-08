<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 19:47
 */

namespace PartnerProgram\Service\Commission;


interface FormulaInterface
{
    /**
     * @param float $amount
     * @return float
     */
    public function evaluate($amount);
}