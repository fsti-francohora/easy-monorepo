<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyIdentity\Exceptions;

use StepTheFkUp\EasyIdentity\Interfaces\IdentityServiceExceptionInterface;

class LoginFailedException extends \RuntimeException implements IdentityServiceExceptionInterface
{
    // No body needed.
}

\class_alias(
    LoginFailedException::class,
    'LoyaltyCorp\EasyIdentity\Exceptions\LoginFailedException',
    false
);
