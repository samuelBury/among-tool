<?php

namespace App\Repository;

use App\Entity\SuivieProduction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SuivieProduction|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuivieProduction|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuivieProduction[]    findAll()
 * @method SuivieProduction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuivieProductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuivieProduction::class);
    }

    // /**
    //  * @return SuivieProduction[] Returns an array of SuivieProduction objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SuivieProduction
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
