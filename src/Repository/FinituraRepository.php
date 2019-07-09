<?php

namespace App\Repository;

use App\Entity\Finitura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Finitura|null find($id, $lockMode = null, $lockVersion = null)
 * @method Finitura|null findOneBy(array $criteria, array $orderBy = null)
 * @method Finitura[]    findAll()
 * @method Finitura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinituraRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Finitura::class);
    }

    // /**
    //  * @return Finitura[] Returns an array of Finitura objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Finitura
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
