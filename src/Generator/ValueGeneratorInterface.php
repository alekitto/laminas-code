<?php

declare(strict_types=1);

namespace Laminas\Code\Generator;

interface ValueGeneratorInterface extends GeneratorInterface
{
    /**#@+
     * Constant values
     */
    public const TYPE_AUTO        = 'auto';
    public const TYPE_BOOLEAN     = 'boolean';
    public const TYPE_BOOL        = 'bool';
    public const TYPE_NUMBER      = 'number';
    public const TYPE_INTEGER     = 'integer';
    public const TYPE_INT         = 'int';
    public const TYPE_FLOAT       = 'float';
    public const TYPE_DOUBLE      = 'double';
    public const TYPE_STRING      = 'string';
    public const TYPE_ARRAY       = 'array';
    public const TYPE_ARRAY_SHORT = 'array_short';
    public const TYPE_ARRAY_LONG  = 'array_long';
    public const TYPE_CONSTANT    = 'constant';
    public const TYPE_NULL        = 'null';
    public const TYPE_ENUM        = 'enum';
    public const TYPE_OBJECT      = 'object';
    public const TYPE_OTHER       = 'other';
    /**#@-*/

    public const OUTPUT_MULTIPLE_LINE = 'multipleLine';
    public const OUTPUT_SINGLE_LINE   = 'singleLine';

    /**
     * @param int $arrayDepth
     * @return self
     */
    public function setArrayDepth($arrayDepth);

    /**
     * @return bool
     */
    public function isValidConstantType();

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type
     * @return self
     */
    public function setType($type);

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param mixed $value
     * @return self
     */
    public function setValue($value);
}
