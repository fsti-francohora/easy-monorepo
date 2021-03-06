<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyDecision\Interfaces;

use StepTheFkUp\EasyDecision\Rules\ExpressionLanguageRule;

interface ExpressionLanguageRuleFactoryInterface
{
    /**
     * Create expression language rule for given expression and priority.
     *
     * @param string $expression
     * @param null|int $priority
     *
     * @return \StepTheFkUp\EasyDecision\Rules\ExpressionLanguageRule
     */
    public function create(string $expression, ?int $priority = null): ExpressionLanguageRule;
}

\class_alias(
    ExpressionLanguageRuleFactoryInterface::class,
    'LoyaltyCorp\EasyDecision\Interfaces\ExpressionLanguageRuleFactoryInterface',
    false
);
