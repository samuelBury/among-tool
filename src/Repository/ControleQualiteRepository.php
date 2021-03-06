<?php

namespace App\Repository;

use App\Entity\ControleQualite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ControleQualite|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControleQualite|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControleQualite[]    findAll()
 * @method ControleQualite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControleQualiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ControleQualite::class);
    }

    /**
     * @param string $value
     * @return array Returns an array of ControleQualite objects
     */

    public function findByComFour(string $value): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.CommandeFournisseur = '.$value)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?ControleQualite
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
