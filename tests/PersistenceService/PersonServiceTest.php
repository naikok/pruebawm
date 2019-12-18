<?php
namespace App\Tests\Command;

use App\PersistenceService\PersonService;
use PHPUnit\Framework\TestCase;
use App\Entity\Person;
use App\Repository\PersonRepository;

class PersonServiceTest extends TestCase
{
    private $entityManagerMock;
    private $personRepositoryMock;

    protected function setUp()
    {
        $this->entityManagerMock = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $this->personRepositoryMock = $this
            ->getMockBuilder(PersonRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        $this->personRepositoryMock = null;
        $this->entityManagerMock  = null;
    }

    public function testfindBySearchQueryReturnArray()
    {
        $output = [];
        $query = "azu";

        $person1 = new Person();
        $person1->setId(1);
        $person1->setColorEyes("azul claro");
        $person1->setColorCar("azul claro");
        $person1->setColorHouse(null);
        $person1->setName("Juan");

        $person2 = new Person();
        $person2->setId(2);
        $person2->setColorEyes("azulados");
        $person2->setColorCar("rojo");
        $person2->setColorHouse("azul");
        $person2->setName("Irene");

        $output[] = $person1;
        $output[] = $person2;

        $this->personRepositoryMock
            ->expects($this->once())
            ->method('findBySearchQuery')
            ->with($query)
            ->willReturn($output);

        $personService = new PersonService($this->entityManagerMock, $this->personRepositoryMock);
        $resultado = $personService->findBySearchQuery($query);

        $this->assertTrue(is_array($resultado) && !empty($resultado));

        if (is_array($resultado) && !empty($resultado)){
            foreach($resultado as $item) {
                $this->assertTrue($item instanceof Person);
            }
        }
    }

    public function testfindBySearchQueryReturnEmpty()
    {
        $output = [];
        $query = "morado";
        $this->personRepositoryMock
            ->expects($this->once())
            ->method('findBySearchQuery')
            ->with($query)
            ->willReturn($output);

        $personService = new PersonService($this->entityManagerMock, $this->personRepositoryMock);
        $resultado = $personService->findBySearchQuery($query);

        $this->assertTrue(is_array($resultado) && empty($resultado));
    }

    public function testsaveOk()
    {
        $person = new Person();
        $person->setId(1);
        $person->setColorEyes("azul claro");
        $person->setColorCar("azul claro");
        $person->setColorHouse(null);
        $person->setName("Juan");


        $emMock = $this->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->setMethods(array('persist', 'flush'))
            ->disableOriginalConstructor()
            ->getMock();

        $emMock->expects($this->exactly(1))
            ->method('persist')
            ->with(
                $this->logicalOr(
                    $this->equalTo($person)
                )
            );

        $emMock->expects($this->exactly(1))
            ->method('flush');

        $personService = new PersonService($emMock, $this->personRepositoryMock);
        $result = $personService->save($person);

        $this->assertTrue($result);
    }

    public function testdeleteOk()
    {
        $person = new Person();
        $person->setId(1);
        $person->setColorEyes("azul claro");
        $person->setColorCar("azul claro");
        $person->setColorHouse(null);
        $person->setName("Juan");


        $emMock = $this->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->setMethods(array('remove', 'flush'))
            ->disableOriginalConstructor()
            ->getMock();

        $emMock->expects($this->exactly(1))
            ->method('remove')
            ->with(
                $this->logicalOr(
                    $this->equalTo($person)
                )
            );

        $emMock->expects($this->exactly(1))
            ->method('flush');

        $personService = new PersonService($emMock, $this->personRepositoryMock);
        $result = $personService->delete($person);

        $this->assertTrue($result);
    }
}