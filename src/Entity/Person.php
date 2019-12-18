<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="Persons")
 */
class Person
{
    /**
     * @ORM\Column(type="integer", name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", name="colorEyes",  nullable=true)
     */
    private $colorEyes;

    /**
     * @ORM\Column(type="string", name="colorCar", nullable=true)
     */
    private $colorCar;


    /**
     * @ORM\Column(type="string", name="colorHouse", nullable=true)
     */
    private $colorHouse;

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getColorEyes() : ?string
    {
        return $this->colorEyes;
    }

    /**
     * @param string $colorEyes
     */
    public function setColorEyes(?string  $colorEyes)
    {
        $this->colorEyes = $colorEyes;
    }

    /**
     * @return string
     */
    public function getColorCar() : ?string
    {
        return $this->colorCar;
    }

    /**
     * @param string $colorCar
     */
    public function setColorCar(?string $colorCar)
    {
        $this->colorCar = $colorCar;
    }

    /**
     * @return string
     */
    public function getColorHouse() : ?string
    {
        return $this->colorHouse;
    }

    /**
     * @param string $colorHouse
     */
    public function setColorHouse(?string  $colorHouse)
    {
        $this->colorHouse = $colorHouse;
    }

    /**
     * @return PersonRepository
     */
    public static function getRepository(EntityManagerInterface $em) : PersonRepository
    {
        return $em->getRepository(__CLASS__);
    }
}
