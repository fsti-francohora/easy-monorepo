<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Resolvers;

use StepTheFkUp\ApiFilters\Interfaces\Resolvers\ResolvedFilterInterface;

final class ResolvedFilter implements ResolvedFilterInterface
{
    /**
     * @var string
     */
    private $comparison;

    /**
     * @var string
     */
    private $property;

    /**
     * @var string
     */
    private $type;

    /**
     * @var mixed
     */
    private $value;

    /**
     * ResolvedFilter constructor.
     *
     * @param string $comparison
     * @param string $property
     * @param string $type
     * @param mixed $value
     */
    public function __construct(string $comparison, string $property, string $type, $value)
    {
        $this->comparison = $comparison;
        $this->property = $property;
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Get comparison.
     *
     * @return string
     */
    public function getComparison(): string
    {
        return $this->comparison;
    }

    /**
     * Get property.
     *
     * @return string
     */
    public function getProperty(): string
    {
        return $this->property;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
