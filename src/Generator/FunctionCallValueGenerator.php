<?php

namespace Laminas\Code\Generator;

use function implode;
use function str_repeat;

class FunctionCallValueGenerator extends AbstractGenerator implements ValueGeneratorInterface
{
    private int $arrayDepth = 1;
    private string $type    = ValueGenerator::TYPE_OTHER;

    public function __construct(private readonly string $name, private readonly array $parameters = [])
    {
        /** @var mixed $value */
        foreach ($this->parameters as &$value) {
            if ($value instanceof ValueGeneratorInterface) {
                continue;
            }

            $value = new ValueGenerator($value);
        }
    }

    public function setArrayDepth(int $arrayDepth): self
    {
        $this->arrayDepth = $arrayDepth;
        return $this;
    }

    public function isValidConstantType(): bool
    {
        return false;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getValue(): mixed
    {
        return null;
    }

    public function setValue(mixed $value): never
    {
        throw new Exception\InvalidArgumentException('Unsupported operation.');
    }

    public function generate(): string
    {
        $ident  = str_repeat($this->indentation, $this->arrayDepth);
        $output = $ident . $this->name;

        $outputParts = [];

        /** @var ValueGeneratorInterface $value */
        foreach ($this->parameters as $value) {
            $outputParts[] = $value->generate();
        }

        if (empty($outputParts)) {
            $output .= '()';
        } else {
            $padding = self::LINE_FEED . str_repeat($this->indentation, $this->arrayDepth + 1);
            $output .= '(' . implode(',' . $padding, $outputParts) . ')';
        }

        return $output;
    }
}
