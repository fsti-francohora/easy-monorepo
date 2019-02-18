<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Interfaces\Mapping;

use EoneoPay\Utils\Interfaces\SerializableInterface;

interface ClientFacingInterface extends SerializableInterface
{
    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get metadata.
     *
     * @return mixed[]
     */
    public function getMetadata(): array;

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug(): string;
}
