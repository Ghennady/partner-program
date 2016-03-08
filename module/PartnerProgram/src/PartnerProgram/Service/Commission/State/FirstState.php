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

class FirstState implements StateInterface
{
    /**
     * @var FormulaInterface
     */
    private $formula;

    /**
     * @var SecondState
     */
    private $nextState;

    /**
     * FirstState constructor.
     * @param FormulaInterface $formula
     * @param StateInterface $nextState
     */
    public function __construct(FormulaInterface $formula, StateInterface $nextState)
    {
        $this->setFormula($formula);
        $this->setNextState($nextState);
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
        return 'Commission for first parent';
    }

    /**
     * @return StateInterface
     */
    public function getNextStep()
    {
        return $this->nextState;
    }

    /**
     * @param StateInterface $nextState
     */
    private function setNextState(StateInterface $nextState)
    {
        $this->nextState = $nextState;
    }
}