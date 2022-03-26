<?php

namespace Flux\Eco\JsonSchemaAsserters\Core\Ports\Models;

use Exception;

interface JsonSchemaBuilder
{
    /** @throws Exception */
    public function appendPropertySchema(string $propertyKey, string $propertyType, ?string $description = null, array $jsonSchemaObjects = []): self;
    public function build(string $id): JsonRootSchema;
}