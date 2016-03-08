<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 08.03.16
 * Time: 19:42
 */

namespace PartnerProgram\Service\Commission;


use PartnerProgram\Entity\Client;
use PartnerProgram\Service\Commission\State\StateInterface;

class State
{
    /**
     * @var StateInterface
     */
    private $currentState;

    /**
     * @var \PartnerProgram\Service\Balance\Operation
     */
    private $balanceOperation;

    /**
     * @return \PartnerProgram\Service\Balance\Operation
     */
    private function getBalanceOperation()
    {
        return $this->balanceOperation;
    }

    /**
     * @param \PartnerProgram\Service\Balance\Operation $balanceOperation
     */
    public function setBalanceOperation(\PartnerProgram\Service\Balance\Operation $balanceOperation)
    {
        $this->balanceOperation = $balanceOperation;
    }

    /**
     * @return StateInterface
     */
    private function getCurrentState()
    {
        return $this->currentState;
    }

    /**
     * @param StateInterface $currentState
     */
    private function setCurrentState(StateInterface $currentState = null)
    {
        $this->currentState = $currentState;
    }

    /**
     * @param StateInterface $state
     */
    public function __construct(StateInterface $state)
    {
        $this->setCurrentState($state);
    }

    /**
     * @return float
     */
    public function payCommission(Client $client, $amount)
    {
        if ($this->getCurrentState() === null) {
            return ;
        }

        $reason = $this->getCurrentState()->getReason();
        $commission = $this->getCurrentState()->getFormula()->evaluate($amount);
        $description = $this->getCurrentState()->getDescription();

        $this->changeState();

        $this->getBalanceOperation()->changeBalance(
            $client,
            $reason,
            $commission,
            $description
        );
    }

    /**
     * @return void
     */
    private function changeState()
    {
        $this->setCurrentState($this->getCurrentState()->getNextStep());
    }
}