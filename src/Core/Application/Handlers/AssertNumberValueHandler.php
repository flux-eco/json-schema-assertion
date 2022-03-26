<?php


declare(strict_types=1);

namespace Flux\Eco\Assert\Core\Application\Handlers;

use RuntimeException;

class AssertNumberValueHandler implements AssertValueTypeHandler
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
        if (is_numeric($value) === false) {
            throw new RuntimeException('Value is not a number value : ' . print_r($value, true));
        }
    }
}