<?php


declare(strict_types=1);

namespace Flux\Eco\Assert\Core\Application\Handlers;

use RuntimeException;

class AssertArrayValueHandler implements AssertValueTypeHandler
{

    private function __construct()
    {

    }

    public static function new(): self
    {
        return new self();
    }

    public function handle(AssertValueTypeCommand $command)
    {
        $value = $command->getValue();
        if (is_array($value) === false) {
            throw new RuntimeException('Value is not a array value : ' . print_r($value, true));
        }
    }
}