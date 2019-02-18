<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Interfaces\Resolvers;

interface ResolvedFilterFactoryInterface
{
    /**
     * Create resolved filter for given data.
     *
     * @param mixed[] $data
     *
     * @return \StepTheFkUp\ApiFilters\Interfaces\Resolvers\ResolvedFilterInterface
     *
     * @throws \StepTheFkUp\ApiFilters\Exceptions\InvalidArgumentException If missing data
     */
    public function create(array $data): ResolvedFilterInterface;
}
