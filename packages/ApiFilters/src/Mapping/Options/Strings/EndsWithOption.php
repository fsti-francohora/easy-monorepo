<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Options\Strings;

use StepTheFkUp\ApiFilters\Mapping\Options\AbstractOption;

final class EndsWithOption extends AbstractOption
{
    /**
     * Get comparison.
     *
     * @return string
     */
    public function getComparison(): string
    {
        return 'ends_with';
    }

    /**
     * Get default option description.
     *
     * @return string
     */
    protected function getDefaultDescription(): string
    {
        return 'Filter properties which end with value';
    }

    /**
     * Get default option name.
     *
     * @return string
     */
    protected function getDefaultName(): string
    {
        return 'Ends with';
    }
}
