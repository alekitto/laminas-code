<?php

namespace Laminas\Code\Generator;

class ConstructorCallValueGenerator extends FunctionCallValueGenerator
{
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
