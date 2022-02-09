<?php

namespace App\Constants;

class Status
{
    public const OPERATION_SUCCESSFUL = 200;
    public const VALIDATION_FAILED = 422;
    public const NOT_FOUND = 404;
    public const INVALID_PASSWORD = 2;




    public static function getMessage($code)
    {
        $messages = [
            self::OPERATION_SUCCESSFUL => "successful",
            self::VALIDATION_FAILED => "Validation failed",
            self::NOT_FOUND => "User Not found",
            self::INVALID_PASSWORD => "invalid password",
        ];

        return $messages[$code];
    }
}
