<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 19:44
 */

namespace PartnerProgram\Service\Commission\State;


use PartnerProgram\Entity\Balance\Reason;
use PartnerProgram\Service\Commission\FormulaInterface;

class SecondState implements StateInterface
{
    /**
     * @var FormulaInterface
     */
    private $formula;

    /**
     * SecondState constructor.
     * @param FormulaInterface $formula
     */
    public function __construct(FormulaInterface $formula)
    {
        $this->setFormula($formula);
    }

    /**
     * @return FormulaInterface
     */
    public function getFormula()
    {
        return $this->formula;
    }

    /**
     * @param FormulaInterface $formula
     */
    private function setFormula(FormulaInterface $formula)
    {
        $this->formula = $formula;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return Reason::COMMISSION;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'Commission for second parent';
    }

    /**
     * @return StateInterface|null
     */
    public function getNextStep()
    {
        return null;
    }
}