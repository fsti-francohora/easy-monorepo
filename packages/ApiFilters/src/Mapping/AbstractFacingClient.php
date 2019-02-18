<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping;

use EoneoPay\Utils\Str;
use EoneoPay\Utils\XmlConverter;
use StepTheFkUp\ApiFilters\Interfaces\Mapping\ClientFacingInterface;

abstract class AbstractFacingClient implements ClientFacingInterface
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var mixed[]
     */
    private $metadata;

    /**
     * @var string
     */
    private $name;

    /**
     * AbstractFacingClient constructor.
     *
     * @param string $name
     * @param string $description
     * @param null|mixed[] $metadata
     */
    public function __construct(string $name, string $description, ?array $metadata = null)
    {
        $this->description = $description;
        $this->name = $name;
        $this->metadata = $metadata ?? [];
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get metadata.
     *
     * @return mixed[]
     */
    public function getMetadata(): array
    {
        return $this->metadata;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug(): string
    {
        return \strtolower((new Str())->snake($this->getName(), '-'));
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Get the contents of the repository as an array
     *
     * @return mixed[]
     */
    public function toArray(): array
    {
        $array = [
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'description' => $this->getDescription(),
            'metadata' => $this->getMetadata()
        ];

        return $array + $this->doToArray();
    }

    /**
     * Generate json from the repository
     *
     * @return string
     */
    public function toJson(): string
    {
        return \json_encode($this->toArray());
    }

    /**
     * Generate XML string from the repository
     *
     * @param string|null $rootNode The name of the root node
     *
     * @return string|null
     *
     * @throws \EoneoPay\Utils\Exceptions\InvalidXmlTagException
     */
    public function toXml(?string $rootNode = null): ?string
    {
        return (new XmlConverter())->arrayToXml($this->toArray(), $rootNode);
    }

    /**
     * Get array representation of child classes.
     *
     * @return mixed[]
     */
    abstract protected function doToArray(): array;
}
