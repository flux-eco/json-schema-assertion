<?php


declare(strict_types=1);

namespace Flux\Eco\Assert\Core\Application\Handlers;

use Flux\Eco\Assert\Core\{Application\Processes, Domain};
use Flux\Eco\JsonSchemaAsserters\Core\Ports\AssertValue;
use RuntimeException;

class AssertPropertyValueTypeHandler implements AssertJsonPropertyValueHandler
{
    private Domain\Models\JsonSchema $schema;

    private array $valueTypeHandlers = [];

    private function __construct(Domain\Models\JsonSchema $schema)
    {
        $this->schema = $schema;
        $this->valueTypeHandlers = [
            Domain\Models\EnumJsonSimpleTypes::STRING => AssertIsStringValueHandler::new(),
            Domain\Models\EnumJsonSimpleTypes::INTEGER => AssertIntValueHandler::new(),
            Domain\Models\EnumJsonSimpleTypes::BOOLEAN => AssertBoolValueHandler::new(),
            Domain\Models\EnumJsonSimpleTypes::NUMBER => AssertNumberValueHandler::new(),
            Domain\Models\EnumJsonSimpleTypes::OBJECT => AssertObjectValueHandler::new(),
            Domain\Models\EnumJsonSimpleTypes::ARRAY => AssertArrayValueHandler::new()
        ];
    }

    public static function new(Domain\Models\JsonSchema $schema): self
    {
        return new self($schema);
    }

    public function handle(Processes\AssertJsonPropertyValueCommand $command)
    {
        $propertyKey = $command->getKey();
        $propertyValue = $command->getValue();

        $jsonSchema = $this->schema->getProperty($propertyKey);

        $valueType = $jsonSchema->getType();

        $assertValueTypeCommand = AssertValueTypeCommand::new($propertyValue);
        $assertValueTypeHandler = $this->valueTypeHandlers[$valueType];
        $this->process($assertValueTypeCommand, $assertValueTypeHandler);
    }

    private function process(AssertValueTypeCommand $command, AssertValueTypeHandler $handler): void
    {
        $handler->handle($command);
    }
}