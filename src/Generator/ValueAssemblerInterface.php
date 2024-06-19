<?php

declare(strict_types=1);

namespace Laminas\Code\Generator;

interface ValueAssemblerInterface
{
    public function assemble(): string;
}
