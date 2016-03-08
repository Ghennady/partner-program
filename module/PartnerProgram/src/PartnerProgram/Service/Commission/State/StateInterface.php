<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 19:51
 */

namespace PartnerProgram\Service\Commission\State;

use PartnerProgram\Service\Commission\FormulaInterface;

interface StateInterface
{
    /**
     * @return FormulaInterface
     */
    public function getFormula();

    /**
     * @return string
     */
    public function getReason();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return StateInterface|null
     */
    public function getNextStep();
}