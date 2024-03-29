<?php

namespace Programic\Rdw\Exceptions;

use Exception;

class UnknownLicenseDataException extends Exception
{
    public function __construct(string $type, string $license)
    {
        parent::__construct('Rdw api: Invalid license, Type: ' . $type . ' en License:' . $license);
    }
}
