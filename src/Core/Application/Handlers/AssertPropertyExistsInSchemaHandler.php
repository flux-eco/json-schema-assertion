<?php


declare(strict_types=1);

namespace Flux\Eco\Assert\Core\Application\Handlers;

use Flux\Eco\Assert\Core\{Application\Processes, Domain};
use RuntimeException;

class AssertPropertyExistsInSchemaHandler implements AssertJsonPropertyValueHandler
{

    private Domain\Models\JsonSchema $schema;

    private function __construct(Domain\Models\JsonSchema $schema)
    {
        $this->schema = $schema;
    }

    public static function new(Domain\Models\JsonSchema $schema): self
    {
        return new self($schema);
    }

    public function handle(Processes\AssertJsonPropertyValueCommand $command)
    {
        $propertyKey = $command->getKey();
        if (array_key_exists($propertyKey, $this->schema->getProperties()) === false) {
            throw new RuntimeException('Property not exists in schema: ' . $propertyKey);
        }
    }
}