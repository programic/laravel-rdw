<?php

namespace Programic\Rdw\Exceptions;

use Exception;

class UnreachableEndpointException extends Exception
{
    public function __construct(string $type)
    {
        parent::__construct('Rdw api: API endpoint (' . $type . ') not available');
    }
}
