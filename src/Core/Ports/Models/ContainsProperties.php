<?php
namespace Flux\Eco\JsonSchemaAsserters\Core\Ports\Models;

interface ContainsProperties
{
    /** @return JsonSchemaObject[] */
    public function getProperties(): array;
}