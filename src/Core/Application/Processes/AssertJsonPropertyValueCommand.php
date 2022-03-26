<?php

namespace Flux\Eco\Assert\Core\Application\Processes;

class AssertJsonPropertyValueCommand
{
    private string $key;
    private mixed $value;

    private function __construct(string $key, mixed $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public static function new(string $key, mixed $value): self
    {
        return new self($key, $value);
    }

    final public function getKey(): string
    {
        return $this->key;
    }

    final public function getValue(): mixed
    {
        return $this->value;
    }
}