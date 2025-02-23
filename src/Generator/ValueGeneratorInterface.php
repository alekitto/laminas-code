<?php

declare(strict_types=1);

namespace Laminas\Code\Generator;

interface ValueGeneratorInterface extends GeneratorInterface
{
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
