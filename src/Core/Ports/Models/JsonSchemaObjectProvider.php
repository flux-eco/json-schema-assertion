<?php


declare(strict_types=1);

namespace Flux\Eco\JsonSchemaAsserters\Core\Ports\Models;

use Exception;
use Flux;
use Flux\Eco\JsonSchemaAsserters\Core\Domain\{Models, Models\JsonStringSchema};

class JsonSchemaObjectProvider
{

    private function __construct()
    {
    }

    public static function new(): self
    {
        return new self();
    }

    /** @param JsonSchemaObject[] $jsonSchemaObjects
     * @throws Exception
     */
    final public function provide(string $key, string $type, ?string $description = null, array $jsonSchemaObjects = []): JsonSchemaObject
    {
        $props = get_defined_vars();

        $this->assertTypeIsJsonType($key, $type);

        //todo assert subItems
        //object -> properties
        //array -> arrayItems
        //other Types empty

        //todo discuss this way of creation
        $modelClassFqcnPath = 'Flux\Eco\JsonSchemaAsserters\Core\Domain\Models';
        $modelClassName = 'Json' . ucfirst($type) . 'SchemaObject';
echo "$modelClassFqcnPath\\$modelClassName";
        return call_user_func_array(["$modelClassFqcnPath\\$modelClassName", 'fromSchemaFile'],$props);

    }

    private function assertTypeIsJsonType(string $key, string $type): void
    {
        if (!in_array($type, Models\EnumJsonSimpleTypes::enum, true)) {
            throw new \RuntimeException('The type ' . $type . ' of ' . $key . ' is not a valid JSON Type');
        }
    }


}