<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Options\Dates\Relatives;

use StepTheFkUp\ApiFilters\Mapping\Options\AbstractOption;

final class MoreThanOption extends AbstractOption
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
        return 'Filter date properties which are more than x days ago';
    }

    /**
     * Get default option name.
     *
     * @return string
     */
    protected function getDefaultName(): string
    {
        return 'More than';
    }
}
