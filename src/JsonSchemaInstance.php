<?php

namespace FluxEco\JsonSchemaAssertion\;



interface JsonSchemaInstance {
    /**
     * Validation succeeds if,
     * for each name that appears in both the instance and as a name within this keyword's value,
     * the child instance for that name successfully validates against the corresponding schema.
     */
    public function assertProperty(int|string|object|array $value, ?string $message);
}