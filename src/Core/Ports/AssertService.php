<?php


namespace Flux\Eco\Assert\Core\Ports;

use Flux\Eco\Assert\Core\{Application\Processes};

class AssertService
{
    private function __construct() {

    }

    public static function new(): self {
        return new self();
    }

    final public function assertJsonPropertyValue(string $key, mixed $value, string $jsonSchemaYamlFilePath): void
    {
        $command = Processes\AssertJsonPropertyValueCommand::new($key, $value);
        Processes\AssertJsonPropertyValueProcess::fromYamlFilePath($jsonSchemaYamlFilePath)->handle($command);
    }

}