<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyDecision\Tests\Helpers;

use StepTheFkUp\EasyDecision\Helpers\FromPhpExpressionFunctionProvider;
use StepTheFkUp\EasyDecision\Tests\AbstractTestCase;

final class FromPhpExpressionFunctionProviderTest extends AbstractTestCase
{
    /**
     * Provider should create expression functions from php functions names.
     *
     * @return void
     */
    public function testGetFunctions(): void
    {
        $phpFunctions = ['max', 'min', 'spl_object_hash', 'is_array'];
        $expressionFunctions = (new FromPhpExpressionFunctionProvider($phpFunctions))->getFunctions();

        foreach ($phpFunctions as $key => $phpFunction) {
            self::assertEquals($phpFunction, $expressionFunctions[$key]->getName());
        }
    }
}

\class_alias(
    FromPhpExpressionFunctionProviderTest::class,
    'LoyaltyCorp\EasyDecision\Tests\Helpers\FromPhpExpressionFunctionProviderTest',
    false
);
