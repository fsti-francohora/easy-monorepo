<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Exceptions;

use StepTheFkUp\ApiFilters\Interfaces\ApiFiltersExceptionInterface;

final class InvalidMappingOptionDataException extends \InvalidArgumentException implements ApiFiltersExceptionInterface
{
    // No body needed.
}
