<?php
/**
 * Created by PhpStorm.
 * User: Game
 * Date: 26/05/2018
 * Time: 08:32
 */

namespace AppBundle\Repository\Impl;


use AppBundle\Repository\IBattleNetRepository;
use Doctrine\ORM\EntityManager;

class BattleNetRepositoryImpl implements IBattleNetRepository {

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @return EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @return mixed
     */
    public function getCharactersWoW(){
        $query = $this->entityManager->createQueryBuilder();
        $query->select("c")
            ->from("AppBundle:CharacterWoW", "c")
            ->getQuery();
        $characters = $query->getQuery()->getResult();
        return $characters;
    }

}