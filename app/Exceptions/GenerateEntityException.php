<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class GenerateEntityException extends Exception
{
    public function __construct(string $message = "Error when trying to generate entity", int $code = 500, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
