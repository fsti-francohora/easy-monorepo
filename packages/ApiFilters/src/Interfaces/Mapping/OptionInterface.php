<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Interfaces\Mapping;

interface OptionInterface extends ClientFacingInterface
{
    /**
     * Get comparison.
     *
     * @return string
     */
    public function getComparison(): string;

    /**
     * Get default value, can be null if no default value needed.
     *
     * @return null|mixed
     */
    public function getDefaultValue();
}
