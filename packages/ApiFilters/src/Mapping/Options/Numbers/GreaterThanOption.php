<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Options\Numbers;

use StepTheFkUp\ApiFilters\Mapping\Options\AbstractOption;

final class GreaterThanOption extends AbstractOption
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
        return 'Filter number properties which are greater than value';
    }

    /**
     * Get default option name.
     *
     * @return string
     */
    protected function getDefaultName(): string
    {
        return 'Greater than';
    }
}
