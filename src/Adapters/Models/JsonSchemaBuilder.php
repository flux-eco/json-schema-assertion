<?php

namespace Flux\Eco\JsonSchemaAsserters\Adapters\Models;

use Exception;
use Flux\Eco\JsonSchemaAsserters\Core\{Ports, Domain};


class JsonSchemaBuilder implements Ports\Models\JsonSchemaBuilder
{
    /** @var  Ports\Models\JsonSchemaObject[] */
    private array $properties = [];
    private Ports\Models\JsonSchemaObjectProvider $jsonSchemaObjectProvider;

    private function __construct()
    {
        $this->jsonSchemaObjectProvider = Ports\Models\JsonSchemaObjectProvider::new();
    }

    public static function new(): self
    {
        return new self();
    }

    /** @throws Exception */
    final public function appendPropertySchema(string $propertyKey, string $propertyType, ?string $description = null, array $jsonSchemaObjects = []): self
    {
        //todo assert propertKey not already set
        $this->properties[$propertyKey] = $this->jsonSchemaObjectProvider->provide($propertyKey, $propertyType, $description, $jsonSchemaObjects);
        return $this;
    }

    //to discuss
    public function build(string $id): Ports\Models\JsonRootSchema
    {
        return Domain\JsonRootSchema::new($id, $this->properties);
    }
}