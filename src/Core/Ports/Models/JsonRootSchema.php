<?php
namespace Flux\Eco\JsonSchemaAsserters\Core\Ports\Models;


interface JsonRootSchema extends ContainsProperties, \JsonSerializable {
    public function getId(): string;
    /** @return JsonSchemaObject[] */
    public function getProperties(): array;
}