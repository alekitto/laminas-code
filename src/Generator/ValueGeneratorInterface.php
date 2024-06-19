<?php

declare(strict_types=1);

namespace Laminas\Code\Generator;

interface ValueGeneratorInterface extends GeneratorInterface
{
    public function setArrayDepth(int $arrayDepth): self;

    public function isValidConstantType(): bool;

    public function getType(): string;

    public function setType(string $type): self;

    public function getValue(): mixed;

    public function setValue(mixed $value): self;
}
