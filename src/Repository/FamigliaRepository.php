<?php

namespace App\Repository;

use App\Entity\Famiglia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Famiglia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Famiglia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Famiglia[]    findAll()
 * @method Famiglia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FamigliaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Famiglia::class);
    }

    // /**
    //  * @return Famiglia[] Returns an array of Famiglia objects
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
    public function findOneBySomeField($value): ?Famiglia
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
