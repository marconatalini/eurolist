<?php

namespace App\Repository;

use App\Entity\Articolo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Articolo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articolo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articolo[]    findAll()
 * @method Articolo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticoloRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Articolo::class);
    }

    public function findArticolo(string $codice)
    {
        $qb = $this->createQueryBuilder('a');

        return $qb->where('a.codice LIKE :codice')
            ->setParameter('codice', "%". $codice ."%")
            ->getQuery()
            ->setMaxResults(50)
            ->getResult()
            ;
    }

    public function findArticoliClasse($classe)
    {
        $qb = $this->createQueryBuilder('a');

        return $qb->join('a.classe', 'c')
            ->where('c.codice = :classe')
            ->setParameter('classe', $classe)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findProfiliSerie($serie)
    {
        $qb = $this->createQueryBuilder('a');

        return $qb->join('a.classe', 'c')
            ->where('c.codice = :classe')
            ->andWhere('a.codice like :serie')
            ->setParameter('classe', 'B1')
            ->setParameter('serie', $serie . '%')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Articolo[] Returns an array of Articolo objects
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
    public function findOneBySomeField($value): ?Articolo
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
