<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Options\Dates\Absolutes;

use StepTheFkUp\ApiFilters\Mapping\Options\AbstractOption;

final class BeforeOption extends AbstractOption
{
    /**
     * Get default option description.
     *
     * @return string
     */
    protected function getDefaultDescription(): string
    {
        return 'Filter date properties which are before value';
    }

    /**
     * Get default option name.
     *
     * @return string
     */
    protected function getDefaultName(): string
    {
        return 'Before';
    }

    /**
     * Get comparison.
     *
     * @return string
     */
    public function getComparison(): string
    {
        return 'lt';
    }
}
