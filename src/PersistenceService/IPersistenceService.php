<?php
namespace App\PersistenceService;

interface IPersistenceService
{
    public function save($object) : bool;

    public function delete($object) : bool;
}
