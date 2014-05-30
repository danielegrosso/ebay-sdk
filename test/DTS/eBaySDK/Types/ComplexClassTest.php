<?php
use DTS\eBaySDK\Mocks\AmountClass;
use DTS\eBaySDK\Mocks\SimpleClass;
use DTS\eBaySDK\Mocks\ComplexClass;

class ComplexClassTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->obj = new ComplexClass();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Mocks\ComplexClass', $this->obj);
    }

    public function testExtendsSimpleClass()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Mocks\SimpleClass', $this->obj);
    }

    public function testGettingSettingProperties()
    {
        $this->obj->foo = 'foo';
        $this->assertEquals('foo', $this->obj->foo);
        $this->assertInternalType('string', $this->obj->foo);
    }

    public function testGettingSettingInheritedProperties()
    {
        $this->obj->integer = 123;
        $this->assertEquals(123, $this->obj->integer);
        $this->assertInternalType('integer', $this->obj->integer);

        $this->obj->string = 'foo';
        $this->assertEquals('foo', $this->obj->string);
        $this->assertInternalType('string', $this->obj->string);

        $this->obj->double = 123.45;
        $this->assertEquals(123.45, $this->obj->double);
        $this->assertInternalType('float', $this->obj->double);

        $this->obj->booleanTrue = true;
        $this->assertEquals(true, $this->obj->booleanTrue);
        $this->assertInternalType('boolean', $this->obj->booleanTrue);

        $this->obj->booleanFalse = false;
        $this->assertEquals(false, $this->obj->booleanFalse);
        $this->assertInternalType('boolean', $this->obj->booleanFalse);

        $date = new \DateTime('2000-01-01', new DateTimeZone("UTC"));
        $this->obj->dateTime = $date;
        $this->assertEquals($date, $this->obj->dateTime);
        $this->assertInstanceOf('\DateTime', $this->obj->dateTime);

        $simpleClass = new SimpleClass();
        $this->obj->simpleClass = $simpleClass;
        $this->assertEquals($simpleClass, $this->obj->simpleClass);
        $this->assertInstanceOf('\DTS\eBaySDK\Mocks\SimpleClass', $this->obj->simpleClass);

        $this->assertEquals(0, count($this->obj->strings));
        $this->assertInstanceOf('\DTS\eBaySDK\Types\UnboundType', $this->obj->strings);

        $this->obj->strings[] = 'foo';
        $this->obj->strings[] = 'bar';
        $this->assertEquals(2, count($this->obj->strings));
        $this->assertEquals('foo', $this->obj->strings[0]);
        $this->assertEquals('bar', $this->obj->strings[1]);
        $this->assertInstanceOf('\DTS\eBaySDK\Types\UnboundType', $this->obj->strings);

        $this->obj->strings = array('foo', 'bar');
        $this->assertEquals(2, count($this->obj->strings));
        $this->assertEquals('foo', $this->obj->strings[0]);
        $this->assertEquals('bar', $this->obj->strings[1]);
        $this->assertInstanceOf('\DTS\eBaySDK\Types\UnboundType', $this->obj->strings);

        $this->obj->strings = array();
        $this->assertEquals(0, count($this->obj->strings));
        $this->assertInstanceOf('\DTS\eBaySDK\Types\UnboundType', $this->obj->strings);

        $this->obj->bish = 'foo';
        $this->assertEquals('foo', $this->obj->bish);
        $this->assertInternalType('string', $this->obj->bish);

        // Should be able to set the property using its element name.
        $this->obj->BISH = 'foo';
        $this->assertEquals('foo', $this->obj->BISH);
        $this->assertInternalType('string', $this->obj->BISH);

        // Set via property name but get from its element name.
        $this->obj->bish = 'foo';
        $this->assertEquals('foo', $this->obj->BISH);

        $this->obj->bishBash = 'foo';
        $this->assertEquals('foo', $this->obj->bishBash);
        $this->assertInternalType('string', $this->obj->bishBash);

        // Should be able to set the property using its element name.
        $this->obj->BishBash = 'foo';
        $this->assertEquals('foo', $this->obj->BishBash);
        $this->assertInternalType('string', $this->obj->BishBash);

        // Set via property name but get from its element name.
        $this->obj->bishBash = 'foo';
        $this->assertEquals('foo', $this->obj->BishBash);
    }

    public function testToXml()
    {
        $this->obj->foo = 'foo';
        $this->obj->integer = 123;
        $this->obj->string = 'a string';
        $this->obj->double = 123.45;
        $this->obj->dateTime = new \DateTime('2000-01-01', new DateTimeZone("UTC"));
        $this->obj->booleanTrue = true;
        $this->obj->booleanFalse = false;

        $simpleClass = new SimpleClass();
        $simpleClass->integer = 321;
        $simpleClass->string = 'another string';
        $this->obj->simpleClass = $simpleClass;

        $amountClass = new AmountClass();
        $amountClass->value = 543.21;
        $amountClass->attributeOne = 'one';
        $amountClass->ATTRIBUTEBISH= 'two';
        $this->obj->amountClass = $amountClass;

        $this->obj->strings = array('foo', 'bar');
        $this->obj->integers = array(1,2,3,4,5);

        $this->obj->simpleClasses = array(
            new SimpleClass(array('integer' => 888)),
            new SimpleClass(array('integer' => 999))
        );

        $this->obj->BISH = 'foo';
        $this->obj->BishBash = 'foo';

        $this->assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/ComplexClassXml.xml', $this->obj->toXml('root', true));
    }
}
