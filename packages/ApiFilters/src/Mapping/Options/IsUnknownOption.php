<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Options;

final class IsUnknownOption extends AbstractOption
{
    /**
     * Get comparison.
     *
     * @return string
     */
    public function getComparison(): string
    {
        return 'unknown';
    }

    /**
     * Get default option description.
     *
     * @return string
     */
    protected function getDefaultDescription(): string
    {
        return 'Filter properties which do not have any value';
    }

    /**
     * Get default option name.
     *
     * @return string
     */
    protected function getDefaultName(): string
    {
        return 'Is unknown';
    }
}
