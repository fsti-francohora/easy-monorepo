<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Options\Booleans;

use StepTheFkUp\ApiFilters\Mapping\Options\AbstractOption;

final class IsFalseOption extends AbstractOption
{
    /**
     * Get comparison.
     *
     * @return string
     */
    public function getComparison(): string
    {
        return 'false';
    }

    /**
     * Get default option description.
     *
     * @return string
     */
    protected function getDefaultDescription(): string
    {
        return 'Filter boolean properties which are false';
    }

    /**
     * Get default option name.
     *
     * @return string
     */
    protected function getDefaultName(): string
    {
        return 'Is false';
    }
}
