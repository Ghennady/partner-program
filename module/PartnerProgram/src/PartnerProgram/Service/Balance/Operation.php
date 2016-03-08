<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 16:10
 */

namespace PartnerProgram\Service\Balance;


use PartnerProgram\Entity\Balance\Operation as BalanceOperation;
use PartnerProgram\Entity\Balance\Reason;
use PartnerProgram\Entity\Client;
use PartnerProgram\Service\EntityManagerAwareInterface;
use PartnerProgram\Service\EntityManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

class Operation implements EntityManagerAwareInterface, EventManagerAwareInterface
{
    use EntityManagerAwareTrait;
    use EventManagerAwareTrait;
    /**
     * @param Client $client
     * @param string $reason
     * @param float $amount
     * @return \PartnerProgram\Entity\Client
     */
    public function changeBalance(Client $client, $reason, $amount, $description)
    {
        $balanceOperation = new BalanceOperation($amount, $client, new Reason($reason), $description);
        $client->changeBalance($balanceOperation);

        $this->getEntityManager()->flush($client);

        $this->getEventManager()->trigger('changeBalance', $this, ['operation' => $balanceOperation]);
        return $client;
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getRepository()
    {
        return $this->getEntityManager()->getRepository(BalanceOperation::class);
    }

    /**
     * @param Client $client
     * @return BalanceOperation[]
     */
    public function findByClient(Client $client)
    {
        return $this->getRepository()->findBy(['client' => $client]);
    }
}