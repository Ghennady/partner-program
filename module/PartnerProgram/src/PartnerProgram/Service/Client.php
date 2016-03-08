<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 15:50
 */

namespace PartnerProgram\Service;


use PartnerProgram\Service\Exception\EntityNotFound;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

class Client implements EntityManagerAwareInterface, EventManagerAwareInterface
{
    use EntityManagerAwareTrait;
    use EventManagerAwareTrait;

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getRepository()
    {
        return $this->getEntityManager()->getRepository(\PartnerProgram\Entity\Client::class);
    }

    public function find($clientId)
    {
        $result = $this->getRepository()->find($clientId);
        
        if ($result === null) {
            throw new EntityNotFound(sprintf('Client "%s" not found', $clientId));
        }

        return $result;
    }

    public function register($name)
    {
        $client = $this->createEntity();
        $client->setName($name);

        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();

        $this->getEventManager()->trigger(__FUNCTION__, $this, ['client' => $client]);
    }

    /**
     * @return \PartnerProgram\Entity\Client
     */
    private function createEntity()
    {
        return new \PartnerProgram\Entity\Client();
    }

    /**
     * @return \PartnerProgram\Entity\Client[]
     */
    public function getClients()
    {
        return $this->getRepository()->findAll();
    }
}