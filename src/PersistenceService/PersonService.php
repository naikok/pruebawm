<?php
namespace App\PersistenceService;

use App\PersistenceService\PersistenceService;
use App\PersistenceService\IPersistenceService;
use App\Entity\Person;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;

class PersonService extends PersistenceService implements IPersistenceService
{
    protected $repository;

    public function __construct(EntityManagerInterface $entityManager, PersonRepository $repository)
    {
        parent::__construct($entityManager);
        $this->repository = $repository;
    }

    /**
     *
     * Function that is the responsible for saving an object into database throughout the  parent save method
     * @param Object $object the object passed must be type of Entity\Person
     * @return bool
     *
     */

    public function save($object) : bool
    {
        return parent::save($object);
    }

    /**
     *
     * Function that is the responsible for saving an object into database throughout the  parent delete method
     * @param Object $object the object passed must be type of Entity\Person
     * @return bool
     *
     */

    public function delete($object): bool
    {
        return parent::delete($object);
    }

    /**
     *
     * Function that is the responsible for fetching the data via query from database
     *
     * @param string $query the term used by the user to search
     * @return array
     *
     */

    public function findBySearchQuery(string $query) : array
    {
        return $this->repository->findBySearchQuery($query);
    }
}
