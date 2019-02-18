<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Filters;

use StepTheFkUp\ApiFilters\Interfaces\Mapping\FilterInterface;
use StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionInterface;
use StepTheFkUp\ApiFilters\Mapping\AbstractFacingClient;

abstract class AbstractFilter extends AbstractFacingClient implements FilterInterface
{
    /**
     * @var \StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionInterface[]
     */
    private $options;

    /**
     * @var string
     */
    private $property;

    /**
     * AbstractFilter constructor.
     *
     * @param string $name
     * @param string $property
     * @param \StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionInterface[] $options
     * @param null|string $description
     * @param null|mixed[] $metadata
     */
    public function __construct(
        string $name,
        string $property,
        array $options,
        ?string $description = null,
        ?array $metadata = null
    ) {
        $this->property = $property;
        $this->options = $options;

        parent::__construct($name, $description ?? $this->getDefaultDescription(), $metadata);
    }

    /**
     * Get the filter options.
     *
     * @return \StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionInterface[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Get the filter target property.
     *
     * @return string
     */
    public function getProperty(): string
    {
        return $this->property;
    }

    /**
     * Get default description.
     *
     * @return string
     */
    abstract protected function getDefaultDescription(): string;

    /**
     * Get array representation of child classes.
     *
     * @return mixed[]
     */
    protected function doToArray(): array
    {
        return [
            'options' => \array_map(function (OptionInterface $option): array {
                return $option->toArray();
            }, $this->getOptions()),
            'property' => $this->getProperty(),
            'type' => $this->getType()
        ];
    }
}
