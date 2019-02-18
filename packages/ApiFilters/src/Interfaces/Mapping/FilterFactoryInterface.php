<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Interfaces\Mapping;

interface FilterFactoryInterface
{
    /**
     * Create mapping filter for given type and data.
     *
     * @param string $type
     * @param mixed[] $data
     *
     * @return \StepTheFkUp\ApiFilters\Interfaces\Mapping\FilterInterface
     *
     * @throws \StepTheFkUp\ApiFilters\Exceptions\InvalidArgumentException If given type not found
     * @throws \StepTheFkUp\ApiFilters\Exceptions\InvalidMappingFilterDataException If filter data invalid
     * @throws \StepTheFkUp\ApiFilters\Exceptions\InvalidMappingOptionDataException If option data invalid
     */
    public function create(string $type, array $data): FilterInterface;
}
