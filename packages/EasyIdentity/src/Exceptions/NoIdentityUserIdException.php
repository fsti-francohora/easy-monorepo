<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyIdentity\Exceptions;

use StepTheFkUp\EasyIdentity\Interfaces\IdentityServiceExceptionInterface;

final class NoIdentityUserIdException extends \RuntimeException implements IdentityServiceExceptionInterface
{
    // No body needed.
}

\class_alias(
    NoIdentityUserIdException::class,
    'LoyaltyCorp\EasyIdentity\Exceptions\NoIdentityUserIdException',
    false
);
