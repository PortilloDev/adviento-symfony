<?php

namespace App\Shared\Domain\Exception;

use App\Shared\Application\Service\PasswordService;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class PasswordException extends BadRequestException
{

    public static function invalidLength(): self
    {
        return new self(sprintf('Password must be at least %d characters long', PasswordService::MIN_PASSWORD_LENGTH));
    }

}