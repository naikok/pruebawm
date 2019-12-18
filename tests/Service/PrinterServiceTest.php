<?php
namespace App\Tests\Command;

use App\Service\PrinterService;
use PHPUnit\Framework\TestCase;
use App\Entity\Person;
use Symfony\Component\HttpFoundation\Response;

class PrinterServiceTest extends TestCase
{

    protected function setUp()
    {

    }

    protected function tearDown()
    {

    }

    public function testprintOutputOk()
    {
        $query = "azu";
        $items =  [];

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

        $items[] = $person1;
        $items[] = $person2;

        $printerService = new PrinterService();
        $result = $printerService->printOutput($items, $query);

        $output = "";
        $output.= "Juan"."\n";
        $output.= "color de los ojos: "."azul claro"."\n";
        $output.= "color del coche: "."azul claro"."\n";
        $output.= "Irene"."\n";
        $output.= "color de los ojos: "."azulados"."\n";
        $output.= "color de la casa: "."azul"."\n";

        $this->assertEquals($output, $result);
    }

    public function testprintOutputEmpty()
    {
        $query = "azu";
        $items =  [];

        $printerService = new PrinterService();
        $result = $printerService->printOutput($items, $query);

        $output = "";

        $this->assertEquals($output, $result);
    }

    public static function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public function testcheckIfContainsSearchTermReturnTrue()
    {

        $person2 = new Person();
        $person2->setId(2);
        $person2->setColorEyes("azulados");
        $person2->setColorCar("rojo");
        $person2->setColorHouse("azul");
        $person2->setName("Irene");

        $printerService = new PrinterService();
        $returnVal = self::invokeMethod($printerService, 'checkIfContainsSearchTerm', array($person2->getColorEyes(), 'azu'));
        $this->assertTrue($returnVal);
    }

    public function testisPropertyNotEmptyAndNotNullReturnFalse()
    {

        $person2 = new Person();
        $person2->setId(2);
        $person2->setColorEyes(null);
        $person2->setColorCar("rojo");
        $person2->setColorHouse("azul");
        $person2->setName("Irene");

        $printerService = new PrinterService();
        $returnVal = self::invokeMethod($printerService, 'isPropertyNotEmptyAndNotNull', array($person2->getColorEyes()));
        $this->assertFalse($returnVal);
    }


    public function testisPropertyNotEmptyAndNotNullReturnTrue()
    {

        $person2 = new Person();
        $person2->setId(2);
        $person2->setColorEyes("azul");
        $person2->setColorCar("rojo");
        $person2->setColorHouse("azul");
        $person2->setName("Irene");

        $printerService = new PrinterService();
        $returnVal = self::invokeMethod($printerService, 'isPropertyNotEmptyAndNotNull', array($person2->getColorEyes()));
        $this->assertTrue($returnVal);
    }
}