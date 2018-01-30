<?php


namespace ArvPayoneApi\Unit\Request;


use ArvPayoneApi\Mocks\Request\TestClass;
use ArvPayoneApi\Request\ArraySerializer;
use ArvPayoneApi\Request\SerializerFactory;


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
        $array = $this->serializer->serialize(new TestClass());
        $this->assertSame(
            [
                'int_zero' => 0,
                'float_zero' => 0.,
            ],
            $array);
    }
}