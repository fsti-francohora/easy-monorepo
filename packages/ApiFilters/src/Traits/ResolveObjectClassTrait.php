<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Traits;

use ReflectionClass;
use StepTheFkUp\ApiFilters\Exceptions\InvalidArgumentException;

trait ResolveObjectClassTrait
{
    /**
     * @var string[]
     */
    private $mapping;

    /**
     * @var string
     */
    private $mustImplement;

    /**
     * @var string
     */
    private $objectName;

    /**
     * @var string[]
     */
    private $resolvedClasses = [];

    /**
     * Resolve class for given type.
     *
     * @param string $type
     *
     * @return string
     *
     * @throws \ReflectionException
     */
    private function resolveClass(string $type): string
    {
        if (isset($this->resolvedClasses[$type])) {
            return $this->resolvedClasses[$type];
        }

        if (isset($this->mapping[$type]) === false) {
            throw new InvalidArgumentException(\sprintf(
                'In "%s", no %s configured for type "%s"',
                \get_class($this),
                $this->objectName,
                $type
            ));
        }

        $class = $this->mapping[$type];

        if ((new ReflectionClass($class))->implementsInterface($this->mustImplement) === false) {
            throw new InvalidArgumentException(\sprintf(
                'In "%s", %s "%s" does not implement interface "%s"',
                \get_class($this),
                $this->objectName,
                $class,
                $this->mustImplement
            ));
        }

        return $this->resolvedClasses[$type] = $class;
    }

    /**
     * Set mapping and take care of simple values without "alias" key.
     *
     * @param string[] $mapping
     *
     * @return void
     */
    private function setMapping(array $mapping): void
    {
        $newMapping = [];

        foreach ($mapping as $key => $value) {
            // 0 => "<value-to-map>"
            if (\is_int($key)) {
                $key = $value;
            }

            $newMapping[$key] = $value;
        }

        $this->mapping = $newMapping;
    }
}
