<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Filters;

final class StringFilter extends AbstractFilter
{
    /**
     * Get filter type.
     *
     * @return string
     */
    public function getType(): string
    {
        return 'string';
    }

    /**
     * Get default description.
     *
     * @return string
     */
    protected function getDefaultDescription(): string
    {
        return 'Filter string properties';
    }
}
