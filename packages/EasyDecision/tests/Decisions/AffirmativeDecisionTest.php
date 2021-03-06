<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyDecision\Tests\Decisions;

use StepTheFkUp\EasyDecision\Decisions\AffirmativeDecision;
use StepTheFkUp\EasyDecision\Interfaces\RuleInterface;
use StepTheFkUp\EasyDecision\Tests\AbstractTestCase;

final class AffirmativeDecisionTest extends AbstractTestCase
{
    /**
     * Decision should return false if no true rules.
     *
     * @return void
     */
    public function testReturnFalseWhenNoTrue(): void
    {
        $decision = (new AffirmativeDecision())->addRules([
            $this->createFalseRule('false-1'),
            $this->createUnsupportedRule('unsupported-1')
        ]);

        $expected = [
            'false-1' => false,
            'unsupported-1' => RuleInterface::OUTPUT_UNSUPPORTED
        ];

        self::assertFalse($decision->make([]));
        self::assertEquals($expected, $decision->getContext()->getRuleOutputs());
    }

    /**
     * Decision should skip all rules after first true and return true.
     *
     * @return void
     */
    public function testReturnTrueAtFirstTrue(): void
    {
        $decision = (new AffirmativeDecision())->addRules([
            $this->createTrueRule('true-1'),
            $this->createTrueRule('true-2'),
            $this->createTrueRule('true-3'),
            $this->createUnsupportedRule('unsupported-1')
        ]);

        $expected = [
            'true-1' => true,
            'true-2' => RuleInterface::OUTPUT_SKIPPED,
            'true-3' => RuleInterface::OUTPUT_SKIPPED,
            'unsupported-1' => RuleInterface::OUTPUT_SKIPPED
        ];

        self::assertTrue($decision->make([]));
        self::assertEquals($expected, $decision->getContext()->getRuleOutputs());
    }

    /**
     * Decision should skip only rules after itself.
     *
     * @return void
     */
    public function testReturnTrueInMiddleOfRules(): void
    {
        $decision = (new AffirmativeDecision())->addRules([
            $this->createFalseRule('false-1'),
            $this->createTrueRule('true-1'),
            $this->createTrueRule('true-2'),
            $this->createUnsupportedRule('unsupported-1')
        ]);

        $expected = [
            'false-1' => false,
            'true-1' => true,
            'true-2' => RuleInterface::OUTPUT_SKIPPED,
            'unsupported-1' => RuleInterface::OUTPUT_SKIPPED
        ];

        self::assertTrue($decision->make([]));
        self::assertEquals($expected, $decision->getContext()->getRuleOutputs());
    }

    /**
     * Decision should return true and run highest priority first.
     *
     * @return void
     */
    public function testReturnTrueWithPriorities(): void
    {
        $decision = (new AffirmativeDecision())->addRules([
            $this->createFalseRule('false-1'),
            $this->createTrueRule('true-1', 100)
        ]);

        $expected = [
            'true-1' => true,
            'false-1' => RuleInterface::OUTPUT_SKIPPED
        ];

        self::assertTrue($decision->make([]));
        self::assertEquals($expected, $decision->getContext()->getRuleOutputs());
    }
}

\class_alias(
    AffirmativeDecisionTest::class,
    'LoyaltyCorp\EasyDecision\Tests\Decisions\AffirmativeDecisionTest',
    false
);
