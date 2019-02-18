<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Filters;

final class DateFilter extends AbstractFilter
{
    /**
     * Get filter type.
     *
     * @return string
     */
    public function getType(): string
    {
        return 'date';
    }

    /**
     * Get default description.
     *
     * @return string
     */
    protected function getDefaultDescription(): string
    {
        return 'Filter date properties';
    }
}
