<?php
/**
 * Created by PhpStorm.
 * User: gag
 * Date: 06.03.16
 * Time: 18:39
 */

namespace PartnerProgram\Service;

use Doctrine\ORM\EntityManager;

interface EntityManagerAwareInterface
{
    public function getEntityManager();

    public function setEntityManager(EntityManager $entityManager);
}