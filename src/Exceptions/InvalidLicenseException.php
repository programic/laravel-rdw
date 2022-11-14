<?php

namespace Programic\Rdw\Exceptions;

use Exception;

class InvalidLicenseException extends Exception
{
    public function __construct($license)
    {
        parent::__construct('Rdw api: Kenteken ongelding of onbekend: '. $license);
    }
}
