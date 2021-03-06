<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyDecision\Rules;

use StepTheFkUp\EasyDecision\Interfaces\ContextInterface;
use StepTheFkUp\EasyDecision\Interfaces\ExpressionLanguageAwareInterface;
use StepTheFkUp\EasyDecision\Interfaces\RuleInterface;
use StepTheFkUp\EasyDecision\Traits\ExpressionLanguageAwareTrait;

final class ExpressionLanguageRule implements RuleInterface, ExpressionLanguageAwareInterface
{
    use ExpressionLanguageAwareTrait;

    /**
     * @var string
     */
    private $expression;

    /**
     * @var int
     */
    private $priority;

    /**
     * ExpressionLanguageRule constructor.
     *
     * @param string $expression
     * @param null|int $priority
     */
    public function __construct(string $expression, ?int $priority = null)
    {
        $this->expression = $expression;
        $this->priority = $priority ?? 0;
    }

    /**
     * Get priority.
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Proceed with input.
     *
     * @param \StepTheFkUp\EasyDecision\Interfaces\ContextInterface $context
     *
     * @return mixed
     */
    public function proceed(ContextInterface $context)
    {
        return $this->expressionLanguage->evaluate($this->expression, $context->getInput());
    }

    /**
     * Check if rule supports given input.
     *
     * @param \StepTheFkUp\EasyDecision\Interfaces\ContextInterface $context
     *
     * @return bool
     */
    public function supports(ContextInterface $context): bool
    {
        return true;
    }

    /**
     * Get string representation of the rule.
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->expression;
    }
}

\class_alias(
    ExpressionLanguageRule::class,
    'LoyaltyCorp\EasyDecision\Rules\ExpressionLanguageRule',
    false
);
