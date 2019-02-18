<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Interfaces\Resolvers;

interface FiltersResolverInterface
{
    /**
     * Resolve filters.
     *
     * @return \StepTheFkUp\ApiFilters\Interfaces\Resolvers\ResolvedFilterInterface[]
     */
    public function resolve(): array;
}
