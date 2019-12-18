<?php
namespace App\Tests\Command;

use App\BusinessService\PersonBusinessService;
use App\PersistenceService\PersonService;
use App\Service\PrinterService;
use PHPUnit\Framework\TestCase;
use App\Entity\Person;
use Symfony\Component\HttpFoundation\Response;

class PersonBusinessServiceTest extends TestCase
{
    private $personServiceMock;
    private $printerServiceMock;

    protected function setUp()
    {
        $this->personServiceMock = $this->getMockBuilder(PersonService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->printerServiceMock = $this->getMockBuilder(PrinterService::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        $this->personServiceMock = null;
        $this->printerServiceMock = null;
    }

    public function testfindBySearchQueryOk()
    {
        $query = "azu";
        $arrayresult =  [];

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

        $arrayresult[] = $person1;
        $arrayresult[] = $person2;

        $this->personServiceMock
            ->expects($this->once())
            ->method('findBySearchQuery')
            ->with($query)
            ->willReturn($arrayresult);

        $output = "";
        $output.= "Juan"."\n";
        $output.= "color de los ojos: "."azul claro"."\n";
        $output.= "color del coche: "."azul claro"."\n";
        $output.= "Irene"."\n";
        $output.= "color de los ojos: "."azulados"."\n";
        $output.= "color de la casa: "."azul"."\n";

        $this->printerServiceMock
            ->expects($this->once())
            ->method('printOutput')
            ->with($arrayresult,$query)
            ->willReturn($output);

        $personBusinessService = new PersonBusinessService($this->personServiceMock, $this->printerServiceMock);
        $response = $personBusinessService->findBySearchQuery($query);

        $this->assertEquals($response, $output);
    }

    public function testfindBySearchQueryThrowException()
    {
        $query = "";
        $personBusinessService = new PersonBusinessService($this->personServiceMock, $this->printerServiceMock);

        try {
            $personBusinessService->findBySearchQuery($query);
        } catch(\Exception $e) {
            $this->assertSame(Response::HTTP_BAD_REQUEST, $e->getCode());
            $this->assertSame("Invalid query was introduced", $e->getMessage());
        }
    }

    public static function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public function testprintQueryFindBySearchQueryOk()
    {

        $arrayresult =  [];

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

        $arrayresult[] = $person1;
        $arrayresult[] = $person2;


        $arg1 = $arrayresult;
        $arg2 = "azu";

        $expected = "";
        $expected.= "Juan"."\n";
        $expected.= "color de los ojos: "." azul claro"."\n";
        $expected.= "color del coche:"." azul claro"."\n";
        $expected.= "Irene"."\n";
        $expected.= "color de los ojos: "."azulados"."\n";
        $expected.= "color de la casa: "."azul"."\n";

        $this->printerServiceMock
            ->expects($this->once())
            ->method('printOutput')
            ->with($arrayresult,$arg2)
            ->willReturn($expected);

        $personBusinessService = new PersonBusinessService($this->personServiceMock, $this->printerServiceMock);
        $returnVal = self::invokeMethod($personBusinessService, 'printQueryFindBySearchQuery', array($arg1, $arg2));
        $this->assertSame($expected ,$returnVal);
    }
}