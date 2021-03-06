<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyDecision\Tests\Decisions;

use StepTheFkUp\EasyDecision\Decisions\ValueDecision;
use StepTheFkUp\EasyDecision\Exceptions\ContextNotSetException;
use StepTheFkUp\EasyDecision\Exceptions\MissingValueIndexException;
use StepTheFkUp\EasyDecision\Exceptions\ReservedContextIndexException;
use StepTheFkUp\EasyDecision\Exceptions\UnableToMakeDecisionException;
use StepTheFkUp\EasyDecision\Interfaces\ContextInterface;
use StepTheFkUp\EasyDecision\Interfaces\RuleInterface;
use StepTheFkUp\EasyDecision\Tests\AbstractTestCase;
use StepTheFkUp\EasyDecision\Tests\Stubs\AssertContextAwareInputRuleStub;
use StepTheFkUp\EasyDecision\Tests\Stubs\ValueContextAwareInputStub;

final class ValueDecisionTest extends AbstractTestCase
{
    /**
     * Decision should throw an exception when trying to get context before calling make.
     *
     * @return void
     */
    public function testGetContextBeforeMakeException(): void
    {
        $this->expectException(ContextNotSetException::class);

        ((new ValueDecision())->addRules([$this->createUnsupportedRule('whatever')]))->getContext();
    }

    /**
     * Decision should throw an exception when given input is an array and "value" index isn't set.
     *
     * @return void
     */
    public function testNotSetValueInInputArrayException(): void
    {
        $this->expectException(MissingValueIndexException::class);

        $decision = (new ValueDecision())->addRules([$this->getModifyValueRuleInArray()]);

        $decision->make([]);
    }

    /**
     * Decision should throw an exception when given input is an array and contains the reserved "context" index.
     *
     * @return void
     */
    public function testReservedContextInInputArrayException(): void
    {
        $this->expectException(ReservedContextIndexException::class);

        $decision = (new ValueDecision())->addRules([$this->getModifyValueRuleInArray()]);

        $decision->make(['context' => 'I know it is bad...', 'value' => 'value']);
    }

    /**
     * Decision should return modified array input.
     *
     * @return void
     */
    public function testReturnModifiedArrayInputSuccessfully(): void
    {
        $modifyRule = $this->getModifyValueRuleInArray();

        $decision = (new ValueDecision())->addRules([
            $this->createUnsupportedRule('unsupported-1'),
            $modifyRule
        ]);

        $original = ['value' => 0];
        $expected = ['value' => 10];

        $expectedRuleOutput = [
            'unsupported-1' => RuleInterface::OUTPUT_UNSUPPORTED,
            $modifyRule->toString() => 10
        ];

        self::assertEquals($expected, $decision->make($original));
        self::assertEquals($expectedRuleOutput, $decision->getContext()->getRuleOutputs());
        self::assertEquals($original, $decision->getContext()->getOriginalInput());
    }

    /**
     * Decision should inject context in input if ContextAwareInterface.
     *
     * @return void
     */
    public function testReturnModifiedObjectInputContextAwareSuccessfully(): void
    {
        // Assertion done in AssertContextAwareInputRuleStub
        $decision = (new ValueDecision())->addRules([new AssertContextAwareInputRuleStub()]);

        $input = new ValueContextAwareInputStub(10);

        $decision->make($input);
    }

    /**
     * Decision should return modified object input.
     *
     * @return void
     */
    public function testReturnModifiedObjectInputSuccessfully(): void
    {
        $modifyRule = $this->getModifyValueRuleInObject();

        $decision = (new ValueDecision())->addRules([
            $this->createUnsupportedRule('unsupported-1'),
            $modifyRule
        ]);

        $original = new \stdClass();
        $original->value = 0;

        $expected = new \stdClass();
        $expected->value = 10;

        $expectedRuleOutput = [
            'unsupported-1' => RuleInterface::OUTPUT_UNSUPPORTED,
            $modifyRule->toString() => 10
        ];

        self::assertEquals($expected, $decision->make($original));
        self::assertEquals($expectedRuleOutput, $decision->getContext()->getRuleOutputs());
        self::assertEquals($original, $decision->getContext()->getOriginalInput());
    }

    /**
     * Decision should throw exception if anything goes wrong in rules.
     *
     * @return void
     */
    public function testUnableToMakeDecisionWhenExceptionInRules(): void
    {
        $this->expectException(UnableToMakeDecisionException::class);

        $decision = (new ValueDecision())->addRule($this->getExceptionRule());

        $decision->make(['value' => 1]);
    }

    /**
     * Get rule to throw exception.
     *
     * @return \StepTheFkUp\EasyDecision\Interfaces\RuleInterface
     */
    private function getExceptionRule(): RuleInterface
    {
        return new class implements RuleInterface {
            /**
             * Get priority.
             *
             * @return int
             */
            public function getPriority(): int
            {
                return 0;
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
                throw new \Exception('');
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
                return 'exception';
            }
        };
    }

    /**
     * Get rule to modify value from input.
     *
     * @return \StepTheFkUp\EasyDecision\Interfaces\RuleInterface
     */
    private function getModifyValueRuleInArray(): RuleInterface
    {
        return new class implements RuleInterface {
            /**
             * Get priority.
             *
             * @return int
             */
            public function getPriority(): int
            {
                return 0;
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
                $input = $context->getInput();

                return $input['value'] + 10;
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
                return isset($context->getInput()['value']);
            }

            /**
             * Get string representation of the rule.
             *
             * @return string
             */
            public function toString(): string
            {
                return 'Add_10_to_value';
            }
        };
    }

    /**
     * Get rule to modify value from input.
     *
     * @return \StepTheFkUp\EasyDecision\Interfaces\RuleInterface
     */
    private function getModifyValueRuleInObject(): RuleInterface
    {
        return new class implements RuleInterface {
            /**
             * Get priority.
             *
             * @return int
             */
            public function getPriority(): int
            {
                return 0;
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
                $input = $context->getInput();

                return $input->value + 10;
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
                return \is_object($context->getInput()) && \property_exists($context->getInput(), 'value');
            }

            /**
             * Get string representation of the rule.
             *
             * @return string
             */
            public function toString(): string
            {
                return 'Add_10_to_value';
            }
        };
    }
}

\class_alias(
    ValueDecisionTest::class,
    'LoyaltyCorp\EasyDecision\Tests\Decisions\ValueDecisionTest',
    false
);
