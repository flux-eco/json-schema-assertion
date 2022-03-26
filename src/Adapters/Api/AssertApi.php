<?php

namespace FluxEco\JsonSchemaAssertion\Api;

use  Flux\Eco\Assert\Core\Ports;

class AssertApi
{
    private Ports\AssertService $jsonSchemaService;

    private function __construct(Ports\AssertService $jsonSchemaService)
    {
        $this->jsonSchemaService = $jsonSchemaService;
    }

    public static function new(): self
    {
        $jsonSchemaService = Ports\AssertService::new();
        return new self($jsonSchemaService);
    }


    public function jsonPropertyValueAssertion(string $key, mixed $value, string $jsonSchemaYamlFilePath): void
    {
        $this->jsonSchemaService->assertJsonPropertyValue($key, $value, $jsonSchemaYamlFilePath);
    }
}