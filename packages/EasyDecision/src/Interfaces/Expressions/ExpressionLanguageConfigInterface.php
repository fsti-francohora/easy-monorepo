<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyDecision\Interfaces\Expressions;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage as BaseExpressionLanguage;

interface ExpressionLanguageConfigInterface
{
    /**
     * Get base expression language instance.
     *
     * @return null|\Symfony\Component\ExpressionLanguage\ExpressionLanguage
     */
    public function getBaseExpressionLanguage(): ?BaseExpressionLanguage;

    /**
     * Get function providers.
     *
     * @return null|mixed[]
     */
    public function getFunctionProviders(): ?array;

    /**
     * Get functions.
     *
     * @return null|mixed[]
     */
    public function getFunctions(): ?array;
}

\class_alias(
    ExpressionLanguageConfigInterface::class,
    'LoyaltyCorp\EasyDecision\Interfaces\Expressions\ExpressionLanguageConfigInterface',
    false
);
