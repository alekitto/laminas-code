<?php

declare(strict_types=1);

namespace LaminasTest\Code\Generator;

use Laminas\Code\Generator\AttributeGenerator;
use LaminasTest\Code\Generator\Fixture\AttributeGenerator\ClassWithArgumentWithAttributes;
use LaminasTest\Code\Generator\Fixture\AttributeGenerator\ClassWithManyArgumentsWithAttributes;
use LaminasTest\Code\Generator\Fixture\AttributeGenerator\ClassWithSimpleAndArgumentedAttributes;
use LaminasTest\Code\Generator\Fixture\AttributeGenerator\ClassWithSimpleAttribute;
use LaminasTest\Code\Generator\Fixture\AttributeGenerator\ClassWithTwoSameSimpleAttributes;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

final class AttributeGeneratorByReflectionTest extends TestCase
{
    public function testGenerateSingleAttribute(): void
    {
        $classWithSimpleAttribute = new ClassWithSimpleAttribute();
        $generator                = $this->giveGenerator($classWithSimpleAttribute);

        $result = $generator->generate();

        $expectedResult = '#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\SimpleAttribute]';
        $this->assertSame($expectedResult, $result);
    }

    public function testGenerateManySingleAttributes(): void
    {
        $classWithSimpleAttribute = new ClassWithTwoSameSimpleAttributes();
        $generator                = $this->giveGenerator($classWithSimpleAttribute);

        $result = $generator->generate();

        $expectedResult = "#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\SimpleAttribute]\n#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\SimpleAttribute]";
        $this->assertSame($expectedResult, $result);
    }

    public function testGenerateSingleAttributeWithArguments(): void
    {
        $classWithSimpleAttribute = new ClassWithArgumentWithAttributes();
        $generator                = $this->giveGenerator($classWithSimpleAttribute);

        $result = $generator->generate();

        $expectedResult = "#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\AttributeWithArguments(boolArgument: false, stringArgument: 'char chain', intArgument: 16)]";
        $this->assertSame($expectedResult, $result);
    }

    public function testGenerateManyAttributesWithArguments(): void
    {
        $classWithSimpleAttribute = new ClassWithManyArgumentsWithAttributes();
        $generator                = $this->giveGenerator($classWithSimpleAttribute);

        $result = $generator->generate();

        $expectedResult = "#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\AttributeWithArguments(boolArgument: false, stringArgument: 'char chain', intArgument: 16)]\n#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\AttributeWithArguments]";
        $this->assertSame($expectedResult, $result);
    }

    public function testMixSimpleAttributesWithAttributesWithArguments(): void
    {
        $classWithSimpleAttribute = new ClassWithSimpleAndArgumentedAttributes();
        $generator                = $this->giveGenerator($classWithSimpleAttribute);

        $result = $generator->generate();

        $expectedResult = "#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\AttributeWithArguments(stringArgument: 'any string', intArgument: 1, boolArgument: true)]\n#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\SimpleAttribute]";
        $this->assertSame($expectedResult, $result);
    }

    private function giveGenerator(object $class): AttributeGenerator
    {
        $reflection = new ReflectionClass($class);
        $generator  = AttributeGenerator::fromReflection($reflection);
        $generator->setIndentation('');

        return $generator;
    }
}
