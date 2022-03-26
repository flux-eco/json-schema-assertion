<?php


declare(strict_types=1);

namespace Flux\Eco\Assert\Core\Application\Handlers;

use RuntimeException;

class AssertIntValueHandler implements AssertValueTypeHandler
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
        if (is_int($value) === false) {
            throw new RuntimeException('Value is not a int value : ' . print_r($value, true));
        }
    }
}