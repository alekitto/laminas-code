<?php

declare(strict_types=1);

namespace Laminas\Code\Generator\AttributeGenerator;

use ReflectionAttribute;

/**
 * @template T of object
 * @template-extends ReflectionAttribute<T>
 */
final class AttributePrototype extends ReflectionAttribute
{
    /**
     * @param non-empty-string $attributeName
     * @param mixed[] $arguments
     */
    public function __construct(private string $attributeName, private array $arguments = [])
    {
    }

    public function getName(): string
    {
        return $this->attributeName;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }
}
