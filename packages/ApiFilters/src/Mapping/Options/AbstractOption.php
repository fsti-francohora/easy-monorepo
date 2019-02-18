<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping\Options;

use StepTheFkUp\ApiFilters\Interfaces\Mapping\OptionInterface;
use StepTheFkUp\ApiFilters\Mapping\AbstractFacingClient;

abstract class AbstractOption extends AbstractFacingClient implements OptionInterface
{
    /**
     * @var null|mixed
     */
    private $default;

    /**
     * AbstractOption constructor.
     *
     * @param null|string $name
     * @param null|mixed $default
     * @param null|string $description
     * @param null|mixed[] $metadata
     */
    public function __construct(
        ?string $name = null,
        $default = null,
        ?string $description = null,
        ?array $metadata = null
    ) {
        $this->default = $default;

        parent::__construct(
            $name ?? $this->getDefaultName(),
            $description ?? $this->getDefaultDescription(),
            $metadata
        );
    }

    /**
     * Get default value, can be null if no default value needed.
     *
     * @return null|mixed
     */
    public function getDefaultValue()
    {
        return $this->default;
    }

    /**
     * Get default option description.
     *
     * @return string
     */
    abstract protected function getDefaultDescription(): string;

    /**
     * Get default option name.
     *
     * @return string
     */
    abstract protected function getDefaultName(): string;

    /**
     * Get array representation of child classes.
     *
     * @return mixed[]
     */
    protected function doToArray(): array
    {
        return ['comparison' => $this->getComparison(), 'default_value' => $this->getDefaultValue()];
    }
}
