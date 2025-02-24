<?php

namespace Laminas\Code\Generator;

final class ConstructorCallValueGenerator extends FunctionCallValueGenerator
{
    public function __construct(string $name, array $parameters = [])
    {
        parent::__construct($name, $parameters);
        $this->setIndentation('');
    }

    public function generate(): string
    {
        return 'new ' . parent::generate();
    }

    public function isValidConstantType(): bool
    {
        return true;
    }

    public function getType(): string
    {
        return ValueGenerator::TYPE_CONSTANT;
    }
}
