<?php


declare(strict_types=1);

namespace Flux\Eco\Assert\Core\Domain\Models;

use Flux\Eco\JsonSchemaAsserters\Core\{Ports};

class JsonSchema
{
    private string $type;
    /** @var JsonSchema[] */
    private array $properties;
    private ?string $description;


    private function __construct(string $type, ?string $description = null, array $properties = [])
    {
        $this->type = $type;
        $this->properties = $properties;
        $this->description = $description;
    }

    //TODO
    public static function fromArray(array $arrayJsonSchema): self
    {
        $type = $arrayJsonSchema['type'];

        $properties = [];
        if (!empty($arrayJsonSchema['properties'])) {
            foreach ($arrayJsonSchema['properties'] as $key => $property) {
                $properties[$key] = self::fromArray($property);
            }
        }
        $description = '';
        if (!empty($schema['description'])) {
            $description = $arrayJsonSchema['$description'];
        }


        return new self($type, $description, $properties);
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return JsonSchema[]
     */
    final public function getProperties(): array
    {
        return $this->properties;
    }


    final public function hasProperty(string $propertyKey): bool
    {
        return (array_key_exists($propertyKey, $this->properties));
    }

    final public function getProperty(string $propertyKey): JsonSchema
    {
        return $this->properties[$propertyKey];
    }


    final public function getDescription(): ?string
    {
        return $this->description;
    }
}