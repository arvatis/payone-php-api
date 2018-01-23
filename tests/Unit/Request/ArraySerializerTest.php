<?php


namespace ArvPayoneApi\Unit\Request;


use ArvPayoneApi\Request\ArraySerializer;
use ArvPayoneApi\Request\SerializerFactory;

class TestObject
{
    private $intZero = 0;
    private $floatZero = 0.;
    private $null = null;
    private $emptyString = '';

    /**
     * Getter for IntZero
     * @return int
     */
    public function getIntZero()
    {
        return $this->intZero;
    }

    /**
     * Getter for FloatZero
     * @return float
     */
    public function getFloatZero()
    {
        return $this->floatZero;
    }

    /**
     * Getter for Null
     * @return null
     */
    public function getNull()
    {
        return $this->null;
    }

    /**
     * Getter for EmptyString
     * @return string
     */
    public function getEmptyString()
    {
        return $this->emptyString;
    }


}

class ArraySerializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ArraySerializer
     */
    private $serializer;

    public function setUp()
    {
        $this->serializer = SerializerFactory::createArraySerializer();
    }

    public function testSerializerDoesNotDeleteZeroValues()
    {
        $array = $this->serializer->serialize(new TestObject());
        $this->assertSame(
            [
                'int_zero' => 0,
                'float_zero' => 0.,
            ],
            $array);
    }
}