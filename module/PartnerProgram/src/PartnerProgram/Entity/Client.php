<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 10:35
 */

namespace PartnerProgram\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as Orm;
use PartnerProgram\Entity\Balance\Operation;
use PartnerProgram\Entity\Balance\Reason;


/**
 * @Orm\Entity
 * @Orm\Table(name="client")
 */
class Client
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
     * @var string
     *
     * @Orm\Column(type="string")
     */
    private $name;

    /**
     * @var float
     *
     * @Orm\Column(type="float")
     */
    private $balance;

    /**
     * @var \Doctrine\Common\Collections\Collection|Operation[]
     *
     * @Orm\OneToMany(targetEntity="\PartnerProgram\Entity\Balance\Operation", mappedBy="client", cascade={"persist"})
     */
    private $balanceOperations;

    public function __construct()
    {
        $this->balanceOperations = new ArrayCollection();
        $this->balance = 0;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param Operation $balanceOperation
     * @return float
     */
    public function changeBalance(Operation $balanceOperation)
    {
        if ($balanceOperation->isNegative() && $this->getBalance() < $balanceOperation->getAmount()) {
            throw new \DomainException(sprintf('Can\'t withdraw %s, because current balance %s', $balanceOperation->getAmount(), $this->getBalance()));
        }

        $this->balanceOperations->add($balanceOperation);
        $this->balance = $balanceOperation->apply($this->balance);

        return $this->getBalance();
    }
}