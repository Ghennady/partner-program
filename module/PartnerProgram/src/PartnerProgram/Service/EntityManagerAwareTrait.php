<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 18:40
 */

namespace PartnerProgram\Service;


use Doctrine\ORM\EntityManager;

trait EntityManagerAwareTrait
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}