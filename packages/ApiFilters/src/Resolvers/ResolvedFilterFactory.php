<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Factories;

use StepTheFkUp\ApiFilters\Exceptions\InvalidArgumentException;
use StepTheFkUp\ApiFilters\Interfaces\Resolvers\ResolvedFilterFactoryInterface;
use StepTheFkUp\ApiFilters\Interfaces\Resolvers\ResolvedFilterInterface;
use StepTheFkUp\ApiFilters\Resolvers\ResolvedFilter;

final class ResolvedFilterFactory implements ResolvedFilterFactoryInterface
{
    /**
     * @var string[]
     */
    private static $required = [
        'comparison',
        'property',
        'type',
        'value'
    ];

    /**
     * Create resolved filter for given data.
     *
     * @param mixed[] $data
     *
     * @return \StepTheFkUp\ApiFilters\Interfaces\Resolvers\ResolvedFilterInterface
     *
     * @throws \StepTheFkUp\ApiFilters\Exceptions\InvalidArgumentException If missing data
     */
    public function create(array $data): ResolvedFilterInterface
    {
        $this->validateData($data);

        return new ResolvedFilter(
            (string)$data['comparison'],
            (string)$data['property'],
            (string)$data['type'],
            $data['value']
        );
    }

    /**
     * Validate given data has all the required values.
     *
     * @param mixed[] $data
     *
     * @return void
     */
    private function validateData(array $data): void
    {
        foreach (static::$required as $key) {
            if (isset($data[$key])) {
                continue;
            }

            throw new InvalidArgumentException(\sprintf(
                'In "%s", required "%s" data missing',
                \get_class($this),
                $key
            ));
        }
    }
}
