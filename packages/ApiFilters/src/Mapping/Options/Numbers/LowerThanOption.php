<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Options\Numbers;

use StepTheFkUp\ApiFilters\Mapping\Options\AbstractOption;

final class LowerThanOption extends AbstractOption
{
    /**
     * Get comparison.
     *
     * @return string
     */
    public function getComparison(): string
    {
        return 'lt';
    }

    /**
     * Get default option description.
     *
     * @return string
     */
    protected function getDefaultDescription(): string
    {
        return 'Filter number properties which are lower than value';
    }

    /**
     * Get default option name.
     *
     * @return string
     */
    protected function getDefaultName(): string
    {
        return 'Lower than';
    }
}
