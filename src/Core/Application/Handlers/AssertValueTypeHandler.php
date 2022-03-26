<?php


declare(strict_types=1);

namespace Flux\Eco\Assert\Core\Application\Handlers;

use Flux\Eco\Assert\Core\Application\Processes;

interface AssertValueTypeHandler
{
    public function handle(AssertValueTypeCommand $command);
}