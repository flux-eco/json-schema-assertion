<?php

namespace Flux\Eco\JsonSchemaAsserters\Adapters;

use Exception;
use Flux\Eco\JsonSchemaAsserters\{Core\Ports, Adapters\Models};


class Outbounds implements Ports\Configs\Config
{

    private Ports\Models\JsonSchemaBuilder $jsonSchemaBuilder;

    private function __construct()
    {
        $this->jsonSchemaBuilder = Models\JsonSchemaBuilder::new();
    }

    public static function new(): self
    {
        return new self();
    }

    public function getJsonSchemaBuilder(): Ports\Models\JsonSchemaBuilder
    {
        return $this->jsonSchemaBuilder;
    }
}