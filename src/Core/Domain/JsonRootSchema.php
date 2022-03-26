<?php

namespace  Flux\Eco\Assert\Core\Domain;

use Flux\Eco\JsonSchemaAsserters\Core\Ports;


class JsonRootSchema implements Ports\Models\JsonRootSchema
{

    private string $id;
    /** @var Models\JsonSchema[] */
    private array $properties;


    /** @param Models\JsonSchema[] $properties */
    private function __construct(string $id, array $properties)
    {
        $this->id = $id;
        $this->properties = $properties;
    }

    /** @param  Models\JsonSchema[] $properties */
    public static function new(string $id, array $properties): self
    {
        return new self($id, $properties);
    }

    final public function getId(): string
    {
        return $this->id;
    }

    /** @return  Models\JsonSchema[] */
    final public function getProperties(): array
    {
        return $this->properties;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}