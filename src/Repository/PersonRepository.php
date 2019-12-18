<?php
namespace App\Repository;

use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;


class PersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * Function that is the responsible for fetching the data via query from database
     *
     * @param string $query the term used by the user to search
     * @return array Person[]
     *
     */

    public function findBySearchQuery(string $query) : array
    {

        $searchTerms = $this->extractSearchTerms($query);

        if (0 === \count($searchTerms)) {
            return [];
        }

        $queryBuilder = $this->createQueryBuilder('p');

        foreach ($searchTerms as $key => $term) {
            $queryBuilder
                ->orWhere('p.colorEyes LIKE :t_'.$key)
                ->setParameter('t_'.$key, '%'.$term.'%')
                ->orWhere('p.colorHouse LIKE :t_'.$key)
                ->setParameter('t_'.$key, '%'.$term.'%')
                ->orWhere('p.colorCar LIKE :t_'.$key)
            ;
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    /**
     * Transforms the search string into an array of search terms. We explode it to look by several words.
     * @param string $searchQuery the term used by the user to search
     * @return array
     */
    private function extractSearchTerms(string $searchQuery) : array
    {
        $searchQuery = trim(preg_replace('/[[:space:]]+/', ' ', $searchQuery));
        $terms = array_unique(explode(' ', $searchQuery));

        // ignore the search terms that are too short
        return array_filter($terms, function ($term) {
            return 2 <= mb_strlen($term);
        });
    }
}
