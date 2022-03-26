<?php


declare(strict_types=1);

namespace Flux\Eco\Assert\Core\Application\Handlers;

use Flux\Eco\Assert\Core\{Application\Processes, Domain};
use RuntimeException;

class AssertIsStringValueHandler implements AssertValueTypeHandler
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
        if (is_string($value) === false) {
            throw new RuntimeException('Value is not a string value : ' . print_r($value, true));
        }
    }
}