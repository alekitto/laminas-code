<?php

declare(strict_types=1);

namespace LaminasTest\Code\Generator\Fixture\AttributeGenerator;

use Attribute;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_CLASS)]
class AttributeWithArguments
{
    public function __construct(public bool $boolArgument, public string $stringArgument, public int $intArgument)
    {
    }
}
