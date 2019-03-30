<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyDecision\Exceptions;

use StepTheFkUp\EasyDecision\Interfaces\EasyDecisionExceptionInterface;

final class InvalidExpressionException extends \InvalidArgumentException implements EasyDecisionExceptionInterface
{
    // No body needed.
}