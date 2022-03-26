<?php

namespace Flux\Eco\JsonSchemaAsserters\Core\Ports;

interface Assert
{
    public function assertPropertyExistsInSchema(): void;
    public function assertPropertyIsEqual(string|array|object|int|null $currentPropertyState):  void;

}