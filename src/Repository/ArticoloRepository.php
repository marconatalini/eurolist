<?php

namespace App\Repository;

use App\Entity\Articolo;
use App\Pagination\Paginator;
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

    public function findArticoli(int $page = 1, $serie = null, $classe = null) : Paginator
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.id');

        if ($serie) {
            $qb->where('a.id like :serie')
                ->setParameter('serie', $serie.'%');
        }

        if ($classe){
            $qb->join('a.classe', 'c')
                ->andWhere('c.codice = :classe')
                ->setParameter('classe', $classe);
        }

        return (new Paginator($qb))->paginate($page);

    }

    /**
     * @return Articolo[]
     */
    public function findBySearchQuery(string $rawQuery, int $limit = Articolo::NUM_ITEMS): array
    {
        $query = $this->sanitizeSearchQuery($rawQuery);
        $searchTerms = $this->extractSearchTerms($query);

        if (0 === \count($searchTerms)) {
            return [];
        }

        $queryBuilder = $this->createQueryBuilder('a');

        foreach ($searchTerms as $key => $term) {
            $queryBuilder
                ->orWhere('a.id LIKE :t_'.$key)
                ->setParameter('t_'.$key, '%'.$term.'%')
            ;
        }

        return $queryBuilder
            ->orderBy('a.id', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Removes all non-alphanumeric characters except whitespaces.
     */
    private function sanitizeSearchQuery(string $query): string
    {
        return trim(preg_replace('/[[:space:]]+/', ' ', $query));
    }

    /**
     * Splits the search query into terms and removes the ones which are irrelevant.
     */
    private function extractSearchTerms(string $searchQuery): array
    {
        $terms = array_unique(explode(' ', $searchQuery));

        return array_filter($terms, function ($term) {
            return 2 <= mb_strlen($term);
        });
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
