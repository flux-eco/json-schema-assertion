<?php

namespace Flux\Eco\JsonSchemaAsserters\Core\Ports\Configs;

use  Flux\Eco\JsonSchemaAsserters\Core\Ports\Models;

interface Config
{
    public function getJsonSchemaBuilder(): Models\JsonSchemaBuilder;
}