<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ClassNotFoundException extends Exception
{
    public function __construct(string $message = "", int $code = 0, string $class = '', ?Throwable $previous = null)
    {
        if (empty($message)) {
           $message = "EThe class '$class' was not found";
        }
        parent::__construct($message, $code, $previous);
    }
}
