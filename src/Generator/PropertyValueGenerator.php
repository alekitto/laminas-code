<?php

namespace Laminas\Code\Generator;

use ArrayObject as SplArrayObject;
use Laminas\Stdlib\ArrayObject as StdlibArrayObject;

class PropertyValueGenerator implements ValueGeneratorInterface
{
    private ValueGeneratorInterface $innerGenerator;

    /**
     * @param mixed                                 $value
     * @param string                                $type
     * @param ValueGenerator::OUTPUT_*              $outputMode
     * @param null|SplArrayObject|StdlibArrayObject $constants
     */
    public function __construct(
        $value = null,
        $type = ValueGenerator::TYPE_AUTO,
        $outputMode = ValueGenerator::OUTPUT_MULTIPLE_LINE,
        $constants = null
    ) {
        $this->innerGenerator = new ValueGenerator($value, $type, $outputMode, $constants);
        $this->innerGenerator->setArrayDepth(1);
    }

    public static function fromValueGenerator(ValueGeneratorInterface $generator): self
    {
        $gen                 = new self();
        $gen->innerGenerator = $generator;

        return $gen;
    }

    public function setArrayDepth(int $arrayDepth): self
    {
        $this->innerGenerator->setArrayDepth($arrayDepth);
        return $this;
    }

    public function isValidConstantType(): bool
    {
        return $this->innerGenerator->isValidConstantType();
    }

    public function getType(): string
    {
        return $this->innerGenerator->getType();
    }

    public function setType(string $type): self
    {
        $this->innerGenerator->setType($type);
        return $this;
    }

    public function getValue(): mixed
    {
        return $this->innerGenerator->getValue();
    }

    public function setValue(mixed $value): self
    {
        $this->innerGenerator->setValue($value);
        return $this;
    }

    public function generate(): string
    {
        return $this->innerGenerator->generate() . ';';
    }
}
