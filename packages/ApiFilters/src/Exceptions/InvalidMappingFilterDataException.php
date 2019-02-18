<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Exceptions;

use StepTheFkUp\ApiFilters\Interfaces\ApiFiltersExceptionInterface;

final class InvalidMappingFilterDataException extends \InvalidArgumentException implements ApiFiltersExceptionInterface
{
    // No body needed.
}
