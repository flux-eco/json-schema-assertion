<?php


declare(strict_types=1);

namespace Flux\Eco\JsonSchemaAsserters\Core\Ports\Models;

interface JsonSchemaObject
{
    public function getKey(): string;

    public function getType(): string;

    public function getDescription(): ?string;
}