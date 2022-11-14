<?php

namespace Programic\Rdw\Exceptions;

use Exception;

class InvalidLicenseException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Rdw api: Kenteken ongelding of onbekend', $code, $previous);
    }
}
