<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Options\Dates\Absolutes;

use StepTheFkUp\ApiFilters\Mapping\Options\AbstractOption;

final class OnOption extends AbstractOption
{
    /**
     * Get default option description.
     *
     * @return string
     */
    protected function getDefaultDescription(): string
    {
        return 'Filter date properties which are on value';
    }

    /**
     * Get default option name.
     *
     * @return string
     */
    protected function getDefaultName(): string
    {
        return 'On';
    }

    /**
     * Get comparison.
     *
     * @return string
     */
    public function getComparison(): string
    {
        return 'eq';
    }
}
