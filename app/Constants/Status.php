<?php

namespace App\Constants;

class Status
{
    public const OPERATION_SUCCESSFUL = 200;
    public const VALIDATION_FAILED = 422;
    public const NOT_FOUND = 404;
    public const SUCCESSFUL = 1;
    public const INVALID_PASSWORD = 2;
    public const INVALID_NUMBER = 3;
    public const DUPLICATE_INVITATION_LINK = 4;



    public static function getMessage($code)
    {
        $messages = [
            self::OPERATION_SUCCESSFUL => "successful",
            self::VALIDATION_FAILED => "Validation failed",
            self::NOT_FOUND => "User Not found",
            self::INVALID_PASSWORD => "invalid password",
            self::INVALID_NUMBER => "Invalid phone number",
            self::DUPLICATE_INVITATION_LINK => "You have already sent an invitation link to this number",
            self::SUCCESSFUL => "successful",
        ];

        return $messages[$code];
    }
}
