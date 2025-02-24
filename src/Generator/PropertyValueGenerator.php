<?php

namespace Laminas\Code\Generator;

/**
 * @deprecated This class is deprecated. Use {@see ValueGenerator} directly.
 */
class PropertyValueGenerator extends ValueGenerator
{
    protected int $arrayDepth = 1;

    /**
     * @return string
     */
    public function generate()
    {
        return parent::generate() . ';';
    }
}
