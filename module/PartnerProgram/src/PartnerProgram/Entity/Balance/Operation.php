<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 11:58
 */

namespace PartnerProgram\Entity\Balance;

use PartnerProgram\Entity\Client;
use Doctrine\ORM\Mapping as Orm;

/**
 * @Orm\Entity
 * @Orm\Table(name="balance_operation")
 */
class Operation
{
    /**
     * @var int
     *
     * @Orm\Id
     * @Orm\Column(type="integer")
     * @Orm\GeneratedValue
     */
    private $id;

    /**
     * @var float
     *
     * @Orm\Column(type="float")
     */
    private $amount;

    /**
     * @var \PartnerProgram\Entity\Balance\Reason
     *
     * @Orm\Embedded(class="\PartnerProgram\Entity\Balance\Reason")
     */
    private $reason;

    /**
     * @var Client
     *
     * @Orm\ManyToOne(targetEntity="\PartnerProgram\Entity\Client", inversedBy="balanceOperations")
     * @Orm\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @var \DateTime
     *
     * @Orm\Column(type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @Orm\Column(type="string")
     */
    private $description;

    public function __construct($amount, Client $client, Reason $reason, $description)
    {
        if ($amount < 0) {
            throw new \DomainException('Amount must be positive');
        }

        $this->amount = $amount;
        $this->client = $client;
        $this->reason = $reason;
        $this->date = new \DateTime();
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return Reason
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return clone $this->date;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isNegative()
    {
        return $this->getReason()->isWithdrawal();
    }

    /**
     * @param float $balance
     * @return float
     */
    public function apply($balance)
    {
        if ($this->isNegative()) {
            return $balance - $this->getAmount();
        } else {
            return $balance + $this->getAmount();
        }
    }
}