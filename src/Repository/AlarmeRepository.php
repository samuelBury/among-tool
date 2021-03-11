<?php

namespace App\Repository;

use App\Entity\Alarme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Alarme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alarme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alarme[]    findAll()
 * @method Alarme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlarmeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alarme::class);
    }

    // /**
    //  * @return Alarme[] Returns an array of Alarme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Alarme
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
