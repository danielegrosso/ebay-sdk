<?php
use DTS\eBaySDK\Mocks\ComplexClass;

class ConstructTest extends \PHPUnit_Framework_TestCase
{
    public function testSettingPropertiesViaCtor()
    {
        $obj = new ComplexClass(array(
            'foo' => 'foo',
            'integer' => 123,
            'strings' => array('foo', 'bar'),
            'BISH' => 'foo',
            'BishBash' => 'foo'
        ));

        $this->assertEquals('foo', $obj->foo);
        $this->assertInternalType('string', $obj->foo);

        $this->assertEquals(123, $obj->integer);
        $this->assertInternalType('integer', $obj->integer);

        $this->assertEquals(2, count($obj->strings));
        $this->assertEquals('foo', $obj->strings[0]);
        $this->assertEquals('bar', $obj->strings[1]);
        $this->assertInstanceOf('\DTS\eBaySDK\Types\UnboundType', $obj->strings);

        $this->assertEquals('foo', $obj->bish);
        $this->assertInternalType('string', $obj->bish);

        $this->assertEquals('foo', $obj->BISH);
        $this->assertInternalType('string', $obj->BISH);

        $this->assertEquals('foo', $obj->bishBash);
        $this->assertInternalType('string', $obj->bishBash);

        $this->assertEquals('foo', $obj->BishBash);
        $this->assertInternalType('string', $obj->BishBash);
    }

    public function testSettingInvalidPropertyViaCtor()
    {
        $this->setExpectedException('\DTS\eBaySDK\Exceptions\UnknownPropertyException', 'Unknown property: DTS\eBaySDK\Mocks\ComplexClass::bar');

        $obj = new ComplexClass(array(
            'bar' => 'bar'
        ));
    }

    public function testSettingInvalidPropertyTypeViaCtor()
    {
        $this->setExpectedException('\DTS\eBaySDK\Exceptions\InvalidPropertyTypeException', 'Invalid property type: DTS\eBaySDK\Mocks\ComplexClass::string expected <string>, got <integer>');

        $obj = new ComplexClass(array(
            'string' => 123
        ));
    }
}
