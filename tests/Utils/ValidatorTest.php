<?php
namespace App\Tests\Utils;

use App\Utils\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    private $object;

    public function __construct()
    {
        parent::__construct();

        $this->object = new Validator();
    }

    public function testValidateQuery()
    {
        $test = 'azul';
        $this->assertSame($test, $this->object->validateQuery($test));
    }

    public function testValidateQueryEmpty()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The query can not be empty.');
        $this->object->validateQuery('');
    }

}