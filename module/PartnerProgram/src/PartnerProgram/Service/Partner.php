<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 18:35
 */

namespace PartnerProgram\Service;


use PartnerProgram\Entity\Client;
use PartnerProgram\IdGenerate\GeneratorInterface;

class Partner implements EntityManagerAwareInterface
{
    use EntityManagerAwareTrait;

    /**
     * @var GeneratorInterface
     */
    private $idGenerator;

    /**
     * @var PartnerIdStorage
     */
    private $parentPartnerIdStorage;

    /**
     * @return PartnerIdStorage
     */
    private function getParentPartnerIdStorage()
    {
        return $this->parentPartnerIdStorage;
    }

    /**
     * @param PartnerIdStorage $parentPartnerIdStorage
     */
    public function setParentPartnerIdStorage(PartnerIdStorage $parentPartnerIdStorage)
    {
        $this->parentPartnerIdStorage = $parentPartnerIdStorage;
    }

    /**
     * @return GeneratorInterface
     */
    private function getIdGenerator()
    {
        return $this->idGenerator;
    }

    /**
     * @param GeneratorInterface $idGenerator
     */
    public function setIdGenerator(GeneratorInterface $idGenerator)
    {
        $this->idGenerator = $idGenerator;
    }

    /**
     * @param Client $client
     * @return \PartnerProgram\Entity\Partner
     */
    public function createClient(Client $client)
    {
        $partnerId = $this->getIdGenerator()->generate();
        $parentId = $this->getParentPartnerIdStorage()->getPartnerId();
        $parentPartner = $this->findById($parentId);

        $partner = new \PartnerProgram\Entity\Partner($partnerId, $client, $parentPartner);


        $this->getEntityManager()->persist($partner);
        $this->getEntityManager()->flush();

        return $partner;
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getRepository()
    {
        return $this->getEntityManager()->getRepository(\PartnerProgram\Entity\Partner::class);
    }

    /**
     * @param Client $client
     * @return \PartnerProgram\Entity\Partner
     */
    public function fetchByClient(Client $client)
    {
        return $this->getRepository()->findOneBy(['client' => $client]);
    }

    /**
     * @param $id
     * @return \PartnerProgram\Entity\Partner
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }
}