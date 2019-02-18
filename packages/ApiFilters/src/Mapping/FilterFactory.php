<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping;

use StepTheFkUp\ApiFilters\Exceptions\InvalidArgumentException;
use StepTheFkUp\ApiFilters\Exceptions\InvalidMappingFilterDataException;
use StepTheFkUp\ApiFilters\Interfaces\Mapping\FilterFactoryInterface;
use StepTheFkUp\ApiFilters\Interfaces\Mapping\FilterInterface;
use StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionFactoryInterface;
use StepTheFkUp\ApiFilters\Traits\ResolveObjectClassTrait;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface as OptionsResolverExceptionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class FilterFactory implements FilterFactoryInterface
{
    use ResolveObjectClassTrait;

    /**
     * @var string[]
     */
    private $aliases;

    /**
     * @var mixed[]
     */
    private $defaultOptions;

    /**
     * @var \StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionFactoryInterface
     */
    private $optionFactory;

    /**
     * @var string[]
     */
    private $resolvedFilterClasses = [];

    /**
     * FilterFactory constructor.
     *
     * @param string[] $filters
     * @param mixed[] $defaultOptions
     * @param \StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionFactoryInterface $optionFactory
     * @param null|string[] $aliases
     */
    public function __construct(
        array $filters,
        array $defaultOptions,
        OptionFactoryInterface $optionFactory,
        ?array $aliases = null
    ) {
        $this->setMapping($filters);
        $this->objectName = 'filter';
        $this->mustImplement = FilterInterface::class;
        $this->defaultOptions = $defaultOptions;
        $this->optionFactory = $optionFactory;
        $this->aliases = $aliases ?? [];
    }

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
     * @throws \ReflectionException
     */
    public function create(string $type, array $data): FilterInterface
    {
        $this->validateFilterData($data);

        $type = $this->getType($type);
        $filterClass = $this->resolveClass($type);

        return new $filterClass(
            $data['name'],
            $data['property'],
            $this->getOptions($type, $data['options'] ?? null),
            $data['description'] ?? null,
            $data['metadata'] ?? null
        );
    }

    /**
     * Get options for given type and options.
     *
     * @param string $type
     * @param null|mixed[] $options
     *
     * @return \StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionInterface[]
     */
    private function getOptions(string $type, ?array $options = null): array
    {
        if ($options !== null) {
            return $this->optionFactory->createMany($options);
        }

        if (isset($this->defaultOptions[$type])) {
            return $this->optionFactory->createMany($this->defaultOptions[$type]);
        }

        throw new InvalidArgumentException(\sprintf(
            'In "%s", no options provided and no default options for type "%s"',
            \get_class($this),
            $type
        ));
    }

    /**
     * Get type for given type, take care of aliases.
     *
     * @param string $type
     *
     * @return string
     */
    private function getType(string $type): string
    {
        return $this->mapping[$this->aliases[$type] ?? $type];
    }

    /**
     * Validate given filter data.
     *
     * @param mixed $data
     *
     * @return void
     */
    private function validateFilterData(array $data): void
    {
        try {
            (new OptionsResolver())
                ->setDefined(['name', 'property', 'options', 'description', 'metadata'])
                ->setRequired(['name', 'property'])
                ->setAllowedTypes('name', 'string')
                ->setAllowedTypes('property', 'string')
                ->setAllowedTypes('options', ['null', 'array'])
                ->setAllowedTypes('description', ['null', 'string'])
                ->setAllowedTypes('metadata', ['null', 'array'])
                ->resolve($data);
        } catch (OptionsResolverExceptionInterface $exception) {
            throw new InvalidMappingFilterDataException(\sprintf(
                'In "%s", %s',
                \get_class($this),
                $exception->getMessage()
            ));
        }
    }
}
