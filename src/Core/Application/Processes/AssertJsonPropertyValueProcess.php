<?php

namespace Flux\Eco\Assert\Core\Application\Processes;

use Flux\Eco\Assert\Core\{Application\Handlers, Domain};


class AssertJsonPropertyValueProcess
{
    private Domain\Models\JsonSchema $schema;

    private function __construct(Domain\Models\JsonSchema $schema)
    {
        $this->schema = $schema;
    }

    public static function fromYamlFilePath(string $jsonSchemaYamlFilePath): self
    {
        $schemaArray = yaml_parse(file_get_contents($jsonSchemaYamlFilePath));
        $schema = Domain\Models\JsonSchema::fromArray($schemaArray);
        return new self($schema);
    }

    /**
     * @throws \Exception
     */
    public function handle(AssertJsonPropertyValueCommand $command): void
    {
        $propertyExistsInSchemaHandler = Handlers\AssertPropertyExistsInSchemaHandler::new($this->schema);
        $this->process($command, $propertyExistsInSchemaHandler);

        $assertPropertyValueHandler = Handlers\AssertPropertyValueTypeHandler::new($this->schema);
        $this->process($command, $assertPropertyValueHandler);
    }

    /**
     * @throws \Exception
     */
    private function process(AssertJsonPropertyValueCommand $command, Handlers\AssertJsonPropertyValueHandler $handler): void
    {
        $handler->handle($command);
    }
}