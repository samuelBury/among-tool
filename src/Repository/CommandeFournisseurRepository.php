<?php

namespace App\Repository;

use App\Entity\CommandeFournisseur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeFournisseur|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeFournisseur|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeFournisseur[]    findAll()
 * @method CommandeFournisseur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeFournisseurRepository extends ServiceEntityRepository
{


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeFournisseur::class);
    }


    /**
     * @param int $idComCli
     * @return array Returns an array of CommandeFournisseur objects
     */

    public function findByComCli(int $idComCli): array
    {


        return $this->createQueryBuilder('c')
            ->andWhere('c.commandeClient = '.trim($idComCli))
            ->getQuery()
            ->getResult();

    }


    /*
    public function findOneBySomeField($value): ?CommandeFournisseur
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
