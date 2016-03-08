<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 10:30
 */

namespace PartnerProgram\Entity;

use Doctrine\ORM\Mapping as Orm;

/**
 * @Orm\Entity
 * @Orm\Table(name="partner")
 */
class Partner
{
    /**
     * @var string
     *
     * @Orm\Id
     * @Orm\Column(type="string")
     */
    private $id;

    /**
     * @var Client
     *
     * @Orm\OneToOne(targetEntity="\PartnerProgram\Entity\Client")
     * @Orm\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @var Partner|null
     *
     * @Orm\ManyToOne(targetEntity="\PartnerProgram\Entity\Partner")
     * @Orm\JoinColumn(name="parent_partner_id", referencedColumnName="id")
     */
    private $parentPartner;

    /**
     * Partner constructor.
     * @param $id
     * @param Client $client
     * @param Partner|null $parentPartner
     */
    public function __construct($id, Client $client, Partner $parentPartner = null)
    {
        $this->setId($id);
        $this->setClient($client);
        $this->setParentPartner($parentPartner);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    private function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    private function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return null|Partner
     */
    public function getParentPartner()
    {
        return $this->parentPartner;
    }

    /**
     * @param null|Partner $parentPartner
     */
    private function setParentPartner(Partner $parentPartner = null)
    {
        $this->parentPartner = $parentPartner;
    }

    /**
     * @return bool
     */
    public function hasPartnerProgram()
    {
        return $this->getParentPartner() !== null;
    }
}