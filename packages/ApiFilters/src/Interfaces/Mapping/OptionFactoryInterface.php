<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Interfaces\Mapping;

interface OptionFactoryInterface
{
    /**
     * Create mapping option for given type and data.
     *
     * @param string $type
     * @param mixed[] $data
     *
     * @return \StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionInterface
     *
     * @throws \StepTheFkUp\ApiFilters\Exceptions\InvalidArgumentException If given type not found
     * @throws \StepTheFkUp\ApiFilters\Exceptions\InvalidMappingOptionDataException If option data invalid
     */
    public function create(string $type, array $data): OptionInterface;

    /**
     * Create many options for given data.
     *
     * @param mixed[] $data
     *
     * @return \StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionInterface[]
     *
     * @throws \StepTheFkUp\ApiFilters\Exceptions\InvalidArgumentException If given data invalid
     * @throws \StepTheFkUp\ApiFilters\Exceptions\InvalidMappingOptionDataException If option data invalid
     */
    public function createMany(array $data): array;
}
