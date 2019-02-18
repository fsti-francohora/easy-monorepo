<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Filters;

final class NumberFilter extends AbstractFilter
{
    /**
     * Get filter type.
     *
     * @return string
     */
    public function getType(): string
    {
        return 'number';
    }

    /**
     * Get default description.
     *
     * @return string
     */
    protected function getDefaultDescription(): string
    {
        return 'Filter number properties';
    }
}
