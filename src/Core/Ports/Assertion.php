<?php

namespace Flux\Eco\JsonSchemaAsserters\Core\Ports;

interface Assertion
{
    public function assertionSchemaFromYamlFile(string $jsonSchemaYamlFilePath): Assert;

}