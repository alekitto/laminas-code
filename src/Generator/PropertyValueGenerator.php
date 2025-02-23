<?php

namespace Laminas\Code\Generator;

use ArrayObject as SplArrayObject;
use Laminas\Stdlib\ArrayObject as StdlibArrayObject;

class PropertyValueGenerator implements ValueGeneratorInterface
{
    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_AUTO = ValueGenerator::TYPE_AUTO;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_BOOLEAN = ValueGenerator::TYPE_BOOLEAN;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_BOOL = ValueGenerator::TYPE_BOOL;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_NUMBER = ValueGenerator::TYPE_NUMBER;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_INTEGER = ValueGenerator::TYPE_INTEGER;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_INT = ValueGenerator::TYPE_INT;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_FLOAT = ValueGenerator::TYPE_FLOAT;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_DOUBLE = ValueGenerator::TYPE_DOUBLE;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_STRING = ValueGenerator::TYPE_STRING;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_ARRAY = ValueGenerator::TYPE_ARRAY;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_ARRAY_SHORT = ValueGenerator::TYPE_ARRAY_SHORT;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_ARRAY_LONG = ValueGenerator::TYPE_ARRAY_LONG;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_CONSTANT = ValueGenerator::TYPE_CONSTANT;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_NULL = ValueGenerator::TYPE_NULL;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_ENUM = ValueGenerator::TYPE_ENUM;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_OBJECT = ValueGenerator::TYPE_OBJECT;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const TYPE_OTHER = ValueGenerator::TYPE_OTHER;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const OUTPUT_MULTIPLE_LINE = ValueGenerator::OUTPUT_MULTIPLE_LINE;

    /** @deprecated Use constants from {@see ValueGenerator} class */
    public const OUTPUT_SINGLE_LINE = ValueGenerator::OUTPUT_SINGLE_LINE;

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

    /**
     * @param int $arrayDepth
     * @return self
     */
    public function setArrayDepth($arrayDepth)
    {
        $this->innerGenerator->setArrayDepth($arrayDepth);
        return $this;
    }

    /**
     * @return bool
     */
    public function isValidConstantType()
    {
        return $this->innerGenerator->isValidConstantType();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->innerGenerator->getType();
    }

    /**
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->innerGenerator->setType($type);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->innerGenerator->getValue();
    }

    /**
     * @param mixed $value
     * @return self
     */
    public function setValue($value)
    {
        $this->innerGenerator->setValue($value);
        return $this;
    }

    public function generate(): string
    {
        return $this->innerGenerator->generate() . ';';
    }
}
