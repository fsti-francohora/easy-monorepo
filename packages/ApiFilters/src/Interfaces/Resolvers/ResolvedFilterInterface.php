<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Interfaces\Resolvers;

interface ResolvedFilterInterface
{
    /**
     * Get comparison.
     *
     * @return string
     */
    public function getComparison(): string;

    /**
     * Get property.
     *
     * @return string
     */
    public function getProperty(): string;

    /**
     * Get type.
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get value.
     *
     * @return mixed
     */
    public function getValue();
}
