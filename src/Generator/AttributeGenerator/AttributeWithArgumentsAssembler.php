<?php

declare(strict_types=1);

namespace Laminas\Code\Generator\AttributeGenerator;

use Laminas\Code\Generator\Exception;
use Laminas\Code\Generator\ValueGenerator;
use Laminas\Code\Generator\ValueGeneratorInterface;

use function implode;
use function sprintf;

final class AttributeWithArgumentsAssembler extends AbstractAttributeAssembler
{
    public function assemble(): string
    {
        $attributeName = $this->getName();

        $attributeDefinition = AttributePart::T_ATTR_START
            . $attributeName
            . AttributePart::T_ATTR_ARGUMENTS_LIST_START;

        $this->generateArguments($attributeDefinition);

        return $attributeDefinition . AttributePart::T_ATTR_END;
    }

    private function generateArguments(string &$output): void
    {
        $argumentsList = [];

        /** @var mixed $argumentValue */
        foreach ($this->getArguments() as $argumentName => $argumentValue) {
            $value = $argumentValue instanceof ValueGeneratorInterface
                ? $argumentValue
                : new ValueGenerator($argumentValue);

            if (! $value->isValidConstantType()) {
                throw new Exception\RuntimeException(sprintf(
                    'The attribute parameter %s of %s is said to be '
                    . 'constant but does not have a valid constant value.',
                    $argumentName,
                    $this->getName()
                ));
            }

            $argumentsList[] = $argumentName
                . AttributePart::T_ATTR_ARGUMENTS_LIST_ASSIGN_OPERAND
                . $value->generate();
        }

        $output .= implode(AttributePart::T_ATTR_ARGUMENTS_LIST_SEPARATOR, $argumentsList);
        $output .= AttributePart::T_ATTR_ARGUMENTS_LIST_END;
    }
}
