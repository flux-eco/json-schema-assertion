<?php


declare(strict_types=1);

namespace Flux\Eco\Assert\Core\Application\Handlers;

class AssertValueTypeCommand
{
    private mixed $value;

    private function __construct(mixed $value) {
        $this->value = $value;
    }

    public static function new(mixed $value): self {
        return new self($value);
    }

    public function getValue(): mixed {
        return $this->value;
    }
}