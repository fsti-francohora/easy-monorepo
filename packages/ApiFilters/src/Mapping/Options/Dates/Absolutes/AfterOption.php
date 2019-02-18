<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Options\Dates\Absolutes;

use StepTheFkUp\ApiFilters\Mapping\Options\AbstractOption;

final class AfterOption extends AbstractOption
{
    /**
     * Get comparison.
     *
     * @return string
     */
    public function getComparison(): string
    {
        return 'gt';
    }

    /**
     * Get default option description.
     *
     * @return string
     */
    protected function getDefaultDescription(): string
    {
        return 'Filter data properties which are after value';
    }

    /**
     * Get default option name.
     *
     * @return string
     */
    protected function getDefaultName(): string
    {
        return 'After';
    }
}
