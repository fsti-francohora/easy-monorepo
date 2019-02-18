<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Filters;

final class BooleanFilter extends AbstractFilter
{
    /**
     * Get filter type.
     *
     * @return string
     */
    public function getType(): string
    {
        return 'boolean';
    }

    /**
     * Get default description.
     *
     * @return string
     */
    protected function getDefaultDescription(): string
    {
        return 'Filter boolean properties';
    }
}
