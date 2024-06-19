<?php

declare(strict_types=1);

namespace Laminas\Code\Generator;

use Laminas\Code\Generator\AttributeGenerator\AttributeAssembler;
use Laminas\Code\Generator\AttributeGenerator\AttributePrototype;
use Laminas\Code\Generator\AttributeGenerator\AttributeWithArgumentsAssembler;
use Laminas\Code\Generator\AttributeGenerator\SimpleAttributeAssembler;
use ReflectionAttribute;
use ReflectionClass;

use function array_map;
use function implode;

final class AttributeGenerator extends AbstractGenerator
{
    private array $assemblers;

    public function __construct(?string $attributeName = null, array $arguments = [])
    {
        $assemblers = [];
        if (null !== $attributeName) {
            $assemblers[] = new AttributePrototype($attributeName, $arguments);
        }

        $this->assemblers = $assemblers;
    }

    public function generate(): string
    {
        $generatedAttributes = array_map(
            static fn (AttributeAssembler $attributeAssembler) => $attributeAssembler->assemble(),
            $this->assemblers,
        );

        return $this->getIndentation() . implode(AbstractGenerator::LINE_FEED . $this->getIndentation(), $generatedAttributes);
    }

    public static function fromPrototype(AttributePrototype ...$attributePrototype): self
    {
        $generator = new self();
        foreach ($attributePrototype as $prototype) {
            $generator->assemblers[] = self::negotiateAssembler($prototype);
        }

        return $generator;
    }

    public static function fromReflection(ReflectionClass $reflectionClass): self
    {
        $attributes = $reflectionClass->getAttributes();
        $generator  = new self();

        foreach ($attributes as $attribute) {
            $generator->assemblers[] = self::negotiateAssembler($attribute);
        }

        return $generator;
    }

    private static function negotiateAssembler(ReflectionAttribute|AttributePrototype $reflectionPrototype): AttributeAssembler
    {
        $hasArguments = ! empty($reflectionPrototype->getArguments());

        if ($hasArguments) {
            return new AttributeWithArgumentsAssembler($reflectionPrototype);
        }

        return new SimpleAttributeAssembler($reflectionPrototype);
    }
}
