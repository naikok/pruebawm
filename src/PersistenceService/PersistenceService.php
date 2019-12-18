<?php
namespace App\PersistenceService;

use App\PersistenceService\IPersistenceService;
use Doctrine\ORM\EntityManagerInterface;

abstract class PersistenceService implements IPersistenceService
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     *
     * Function that is the responsible for saving an object into database
     * @param Object $object the object passed must be type of Entity
     * @return bool
     *
     */

    protected function persist($object) : bool
    {
        try {
            $this->entityManager->persist($object);
            $this->entityManager->flush();
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     *
     * Function that is the responsible for saving an object into database throughout the persist method
     * @param Object $object the object passed must be type of Entity
     * @return bool
     *
     */
    public function save($object) : bool
    {
        return $this->persist($object);
    }


    /**
     *
     * Function that is the responsible for deleting an object from database
     * @param Object $object the object passed must be type of Entity
     * @return bool
     *
     */

    public function delete($object) : bool
    {
        try {
            $this->entityManager->remove($object);
            $this->entityManager->flush();
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

}
