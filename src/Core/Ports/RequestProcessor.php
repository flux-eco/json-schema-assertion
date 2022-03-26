<?php
/*
 * fluxcapacitor - microservice framework for business domains and business logic
 * Copyright (C) 2021 martin@fluxlabs.ch
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Flux\Eco\JsonSchemaAsserters\Core\Ports;

use Exception;
use Flux\Eco\JsonSchemaAsserters\Core\{Application, Ports\Configs};


class RequestProcessor implements AssertValue, Assertion, Assert
{
    private Models\JsonSchemaBuilder $jsonSchemaBuilder;
    private Application\Operations\AssertProperties $assertProperty;
    private Models\JsonRootSchema $assertionRootSchema;

    private function __construct(Configs\Config $config)
    {
        $this->jsonSchemaBuilder = $config->getJsonSchemaBuilder();
    }

    public static function new(Configs\Config $config): AssertValue
    {
        return new self($config);
    }

    final public function assertProperty(string $propertyKey, string|object|array|int|null $propertyValue): Assertion
    {
        $this->assertProperty = Application\Operations\AssertProperties::new($propertyKey, $propertyValue);
        return $this;
    }


    final public function assertPropertyIsEqual(string|array|object|int|null $currentPropertyState): void
    {

        $assertionStrategy = Application\Middlewares\MiddlewareAssertPropertyIsEqual::new($currentPropertyState);
        Application\Processes\AssertJosnSchemaInstance::new()->process($this->assertProperty, $assertionStrategy);
    }


    /**
     * @throws Exception
     */
    final public function assertionSchemaFromYamlFile(string $jsonSchemaYamlFilePath): Assert
    {
        $jsonSchemaArray = yaml_parse(file_get_contents($jsonSchemaYamlFilePath));
        $jsonSchemaBuilder = $this->jsonSchemaBuilder;

        if (!empty($jsonSchemaArray['properties'])) {
            $propertiesArray = $jsonSchemaArray['properties'];
            foreach ($propertiesArray as $propertyKey => $propertySchema) {
                if(empty($propertySchema['type'])) {
                    //ref todo
                    continue;

                }
                $jsonSchemaBuilder->appendPropertySchema($propertyKey, $propertySchema['type']);
            }
        }
        $this->assertionRootSchema = $jsonSchemaBuilder->build($jsonSchemaArray['$id']);
return $this;
        //TODO
    }

    final public function assertPropertyExistsInSchema(): void
    {
        $assertionStrategy = Application\Tasks\AssertPropertiesHandler::new($this->assertionRootSchema);
        Application\Processes\AssertJosnSchemaInstance::new()->process($this->assertProperty, $assertionStrategy);
    }
}