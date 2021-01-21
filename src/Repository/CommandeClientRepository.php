<?php

namespace App\Repository;

use App\Entity\CommandeClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeClient[]    findAll()
 * @method CommandeClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeClient::class);
    }

    /**
     * @return array Returns an array of CommandeClient objects
     */

    public function findAllActive(): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.active = true')
            ->getQuery()
            ->getResult()
            ->getOneOrNullResult();

    }


    /*
    public function findOneBySomeField($value): ?CommandeClient
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
