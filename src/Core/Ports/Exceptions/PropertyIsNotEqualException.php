<?php

namespace Flux\Eco\JsonSchemaAsserters\Core\Ports\Exceptions;

use Exception;

class PropertyIsNotEqualException extends Exception implements JsonSchemaAssertersException
{
    public function __construct(string $propertyKey, string $propertyAsString, string|null $currentStateAsString)
    {
        parent::__construct('Property ' . $propertyKey . ' :' . $propertyAsString . " is not equal " . $currentStateAsString);
    }
}