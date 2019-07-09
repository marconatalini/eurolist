<?php

namespace App\Repository;

use App\Entity\Listino;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Listino|null find($id, $lockMode = null, $lockVersion = null)
 * @method Listino|null findOneBy(array $criteria, array $orderBy = null)
 * @method Listino[]    findAll()
 * @method Listino[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListinoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Listino::class);
    }

    // /**
    //  * @return Listino[] Returns an array of Listino objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Listino
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
