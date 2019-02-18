<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Interfaces\Mapping;

interface FilterInterface extends ClientFacingInterface
{
    /**
     * Get the filter options.
     *
     * @return \StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionInterface[]
     */
    public function getOptions(): array;

    /**
     * Get the filter target property.
     *
     * @return string
     */
    public function getProperty(): string;

    /**
     * Get filter type.
     *
     * @return string
     */
    public function getType(): string;
}
