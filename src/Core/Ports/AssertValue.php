<?php

namespace Flux\Eco\JsonSchemaAsserters\Core\Ports;

interface AssertValue
{
    public function assertProperty(string $propertyKey, string|object|array|int|null $propertyValue): Assertion;
}