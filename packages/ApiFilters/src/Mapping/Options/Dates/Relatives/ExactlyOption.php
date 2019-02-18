<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Options\Dates\Relatives;

use StepTheFkUp\ApiFilters\Mapping\Options\AbstractOption;

final class ExactlyOption extends AbstractOption
{
    /**
     * Get default option description.
     *
     * @return string
     */
    protected function getDefaultDescription(): string
    {
        return 'Filter date properties which are exactly x days ago';
    }

    /**
     * Get default option name.
     *
     * @return string
     */
    protected function getDefaultName(): string
    {
        return 'Exactly';
    }

    /**
     * Get comparison.
     *
     * @return string
     */
    public function getComparison(): string
    {
        return 'exactly';
    }
}
