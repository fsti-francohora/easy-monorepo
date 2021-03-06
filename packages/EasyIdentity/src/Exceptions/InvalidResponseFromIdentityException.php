<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyIdentity\Exceptions;

use StepTheFkUp\EasyIdentity\Interfaces\IdentityServiceExceptionInterface;

final class InvalidResponseFromIdentityException extends \RuntimeException implements IdentityServiceExceptionInterface
{
    // No body needed.
}

\class_alias(
    InvalidResponseFromIdentityException::class,
    'LoyaltyCorp\EasyIdentity\Exceptions\InvalidResponseFromIdentityException',
    false
);
