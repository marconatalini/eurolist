<?php

namespace App\Repository;

use App\Entity\Articolo;
use App\Entity\Famiglia;
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

    public function findArticoli(int $page = 1, $serie = null, $search = null, $classe = null, $linkTo = null, $famiglie = null) : Paginator
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.id');

        if (null !== $serie) {
            $qb->where('a.id like :serie')
                ->setParameter('serie', $serie.'%');
        }

        if (null !== $classe){
            $qb->join('a.classe', 'c')
                ->orWhere('c.codice = :classe')
                ->setParameter('classe', $classe);
        }

        if (null !== $search) {
            $qb->where('a.id like :search')
                ->setParameter('search', '%'.$search.'%');
        }

        /**
         * @var Articolo[] $linkTo
         */
        if (null !== $linkTo) {
            foreach ($linkTo as $key => $art) {
                $qb->orWhere('a.id = :codice_'.$key)
                    ->setParameter('codice_'.$key, $art->getId());
            }
            if (count($linkTo) == 0) {
                $qb->where('a.id = 1'); // no result
            }
        }

        /**
         * @var Articolo $articolo
         * @var Famiglia $famiglia
         */
        if (null !== $famiglie) {
            foreach ($famiglie as $famiglia){
                foreach ($famiglia->getArticoli() as $key => $art) {
                    $qb->orWhere('a.id = :codice_'.$key)
                        ->setParameter('codice_'.$key, $art->getId());
                }
            }

            if (count($famiglie) == 0) {
                $qb->where('a.id = 1'); //no result
            }
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
