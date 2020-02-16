<?php
declare(strict_types=1);

namespace EonX\EasySecurity;

use EonX\EasyApiToken\Interfaces\EasyApiTokenDecoderInterface;
use EonX\EasyPsr7Factory\Interfaces\EasyPsr7FactoryInterface;
use EonX\EasySecurity\Interfaces\ContextInterface;
use EonX\EasySecurity\Interfaces\ContextModifierInterface;
use EonX\EasySecurity\Interfaces\ContextResolverInterface;
use Symfony\Component\HttpFoundation\Request;
use Traversable;

final class ContextResolver implements ContextResolverInterface
{
    /**
     * @var \EonX\EasySecurity\Interfaces\ContextInterface
     */
    private $context;

    /**
     * @var \EonX\EasySecurity\Interfaces\ContextModifierInterface[]
     */
    private $contextModifiers;

    /**
     * @var \EonX\EasyPsr7Factory\Interfaces\EasyPsr7FactoryInterface
     */
    private $psr7Factory;

    /**
     * @var \EonX\EasyApiToken\Interfaces\EasyApiTokenDecoderInterface
     */
    private $tokenDecoder;

    /**
     * ContextResolver constructor.
     *
     * @param \EonX\EasySecurity\Interfaces\ContextInterface $context
     * @param \EonX\EasyPsr7Factory\Interfaces\EasyPsr7FactoryInterface $psr7Factory
     * @param \EonX\EasyApiToken\Interfaces\EasyApiTokenDecoderInterface $tokenDecoder
     * @param mixed[]|iterable<mixed> $contextModifiers
     */
    public function __construct(
        ContextInterface $context,
        EasyPsr7FactoryInterface $psr7Factory,
        EasyApiTokenDecoderInterface $tokenDecoder,
        iterable $contextModifiers
    ) {
        $this->context = $context;
        $this->psr7Factory = $psr7Factory;
        $this->tokenDecoder = $tokenDecoder;

        $this->setContextModifiers($contextModifiers);
    }

    /**
     * Resolve context for given request.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \EonX\EasySecurity\Interfaces\ContextInterface
     */
    public function resolve(Request $request): ContextInterface
    {
        $this->context->setToken($this->tokenDecoder->decode($this->psr7Factory->createRequest($request)));

        foreach ($this->contextModifiers as $modifier) {
            $modifier->modify($this->context, $request);
        }

        return $this->context;
    }

    /**
     * Filter and sort by priority context modifiers.
     *
     * @param mixed[]|iterable<mixed> $modifiers
     *
     * @return void
     */
    private function setContextModifiers(iterable $modifiers): void
    {
        $modifiers = $modifiers instanceof Traversable ? \iterator_to_array($modifiers) : (array)$modifiers;

        $filter = static function ($resolver): bool {
            return $resolver instanceof ContextModifierInterface;
        };
        $sort = static function (ContextModifierInterface $first, ContextModifierInterface $second): int {
            return $first->getPriority() <=> $second->getPriority();
        };

        $modifiers = \array_filter($modifiers, $filter);
        \usort($modifiers, $sort);

        $this->contextModifiers = $modifiers;
    }
}