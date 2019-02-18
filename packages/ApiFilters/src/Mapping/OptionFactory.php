<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping;

use StepTheFkUp\ApiFilters\Exceptions\InvalidArgumentException;
use StepTheFkUp\ApiFilters\Exceptions\InvalidMappingFilterDataException;
use StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionFactoryInterface;
use StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionInterface;
use StepTheFkUp\ApiFilters\Traits\ResolveObjectClassTrait;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface as OptionsResolverExceptionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class OptionFactory implements OptionFactoryInterface
{
    use ResolveObjectClassTrait;

    /**
     * @var string[]
     */
    private $aliases;

    /**
     * OptionFactory constructor.
     *
     * @param string[] $options
     * @param null|string[] $aliases
     */
    public function __construct(array $options, ?array $aliases = null)
    {
        $this->setMapping($options);
        $this->objectName = 'option';
        $this->mustImplement = OptionInterface::class;
        $this->aliases = $aliases ?? [];
    }

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
     * @throws \ReflectionException
     */
    public function create(string $type, array $data): OptionInterface
    {
        $this->validateOptionData($data);

        $type = $this->getType($type);
        $optionClass = $this->resolveClass($type);

        return new $optionClass(
            $data['name'] ?? null,
            $data['default'] ?? null,
            $data['description'] ?? null,
            $data['metadata'] ?? null
        );
    }

    /**
     * Create many options for given data.
     *
     * @param mixed[] $data
     *
     * @return \StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionInterface[]
     *
     * @throws \StepTheFkUp\ApiFilters\Exceptions\InvalidArgumentException If given data invalid
     * @throws \StepTheFkUp\ApiFilters\Exceptions\InvalidMappingOptionDataException If option data invalid
     * @throws \ReflectionException
     */
    public function createMany(array $data): array
    {
        $options = [];

        foreach ($data as $key => $value) {
            // Already an option instance
            if ($value instanceof OptionInterface) {
                $options[] = $value;

                continue;
            }

            // 0 => OptionClass::class
            if (\is_int($key) && \is_string($value)) {
                $options[] = $this->create($value, []);

                continue;
            }

            // 0 => ['type' => OptionClass::class, <option_data>]
            if (\is_int($key) && \is_array($value) && \is_string($value['type'] ?? null)) {
                $options[] = $this->create($value['type'], $value);
            }

            // OptionClass::class => [<option_data>]
            if (\is_string($key) && \is_array($value)) {
                $options[] = $this->create($key, $value);

                continue;
            }

            throw new InvalidArgumentException(\sprintf(
                'In "%s", invalid options data given. %s',
                \get_class($this),
                \json_encode($data)
            ));
        }

        return $options;
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
     * Validate option data.
     *
     * @param mixed[] $data
     *
     * @return void
     */
    private function validateOptionData(array $data): void
    {
        try {
            (new OptionsResolver())
                ->setDefined(['name', 'default', 'description', 'metadata'])
                ->setAllowedTypes('name', 'string')
                ->setAllowedTypes('default', ['null', 'int', 'float', 'bool', 'array', 'string'])
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
