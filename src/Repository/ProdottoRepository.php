<?php

namespace App\Repository;

use App\Entity\Prodotto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Prodotto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prodotto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prodotto[]    findAll()
 * @method Prodotto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProdottoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Prodotto::class);
    }

    public function findProdotti()
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p', 'a')
            ->leftJoin('p.articolo', 'a')
            ->groupBy('a.codice')
        ;

        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return Prodotto[] Returns an array of Prodotto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Prodotto
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
