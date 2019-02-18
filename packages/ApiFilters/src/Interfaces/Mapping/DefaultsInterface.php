<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Interfaces\Mapping;

interface DefaultsInterface
{
    /**
     * Get default filters aliases list.
     *
     * @return string[]
     */
    public function getFilterAliases(): array;

    /**
     * Get default filters default options list.
     *
     * @return string[]
     */
    public function getFilterDefaultOptions(): array;

    /**
     * Get default filters classes list.
     *
     * @return string[]
     */
    public function getFilters(): array;

    /**
     * Get default options aliases list.
     *
     * @return string[]
     */
    public function getOptionAliases(): array;

    /**
     * Get default options classes list.
     *
     * @return string[]
     */
    public function getOptions(): array;
}
