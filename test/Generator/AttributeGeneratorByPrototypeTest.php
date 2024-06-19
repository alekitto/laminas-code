<?php

declare(strict_types=1);

namespace LaminasTest\Code\Generator;

use Laminas\Code\Generator\AttributeGenerator;
use Laminas\Code\Generator\AttributeGenerator\AttributePrototype;
use LaminasTest\Code\Generator\Fixture\AttributeGenerator\AttributeWithArguments;
use LaminasTest\Code\Generator\Fixture\AttributeGenerator\SimpleAttribute;
use PHPUnit\Framework\TestCase;

final class AttributeGeneratorByPrototypeTest extends TestCase
{
    public function testGenerateSingleAttribute(): void
    {
        $prototype = new AttributePrototype(SimpleAttribute::class);
        $generator = $this->giveGenerator($prototype);

        $result = $generator->generate();

        $expectedResult = '#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\SimpleAttribute]';
        $this->assertSame($expectedResult, $result);
    }

    public function testGenerateManySingleAttributes(): void
    {
        $prototype1 = new AttributePrototype(SimpleAttribute::class);
        $prototype2 = new AttributePrototype(SimpleAttribute::class);
        $generator  = $this->giveGenerator($prototype1, $prototype2);

        $result = $generator->generate();

        $expectedResult = "#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\SimpleAttribute]\n#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\SimpleAttribute]";
        $this->assertSame($expectedResult, $result);
    }

    public function testGenerateSingleAttributeWithArguments(): void
    {
        $prototype = new AttributePrototype(
            AttributeWithArguments::class,
            [
                'boolArgument'   => false,
                'stringArgument' => 'char chain',
                'intArgument'    => 16,
            ],
        );
        $generator = $this->giveGenerator($prototype);

        $result = $generator->generate();

        $expectedResult = "#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\AttributeWithArguments(boolArgument: false, stringArgument: 'char chain', intArgument: 16)]";
        $this->assertSame($expectedResult, $result);
    }

    public function testGenerateManyAttributesWithArguments(): void
    {
        $prototype1 = new AttributePrototype(
            AttributeWithArguments::class,
            [
                'boolArgument'   => false,
                'stringArgument' => 'char chain',
                'intArgument'    => 16,
            ],
        );
        $prototype2 = new AttributePrototype(AttributeWithArguments::class);
        $generator  = $this->giveGenerator($prototype1, $prototype2);

        $result = $generator->generate();

        $expectedResult = "#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\AttributeWithArguments(boolArgument: false, stringArgument: 'char chain', intArgument: 16)]\n#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\AttributeWithArguments]";
        $this->assertSame($expectedResult, $result);
    }

    public function testMixSimpleAttributesWithAttributesWithArguments(): void
    {
        $prototype1 = new AttributePrototype(
            AttributeWithArguments::class,
            [
                'stringArgument' => 'any string',
                'intArgument'    => 1,
                'boolArgument'   => true,
            ]
        );
        $prototype2 = new AttributePrototype(SimpleAttribute::class);
        $generator  = $this->giveGenerator($prototype1, $prototype2);

        $result = $generator->generate();

        $expectedResult = "#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\AttributeWithArguments(stringArgument: 'any string', intArgument: 1, boolArgument: true)]\n#[LaminasTest\Code\Generator\Fixture\AttributeGenerator\SimpleAttribute]";
        $this->assertSame($expectedResult, $result);
    }

    private function giveGenerator(AttributePrototype ...$prototype): AttributeGenerator
    {
        $generator = AttributeGenerator::fromPrototype(...$prototype);
        $generator->setIndentation('');

        return $generator;
    }
}
