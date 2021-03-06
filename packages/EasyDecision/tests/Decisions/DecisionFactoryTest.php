<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyDecision\Tests\Decisions;

use StepTheFkUp\EasyDecision\Decisions\DecisionConfig;
use StepTheFkUp\EasyDecision\Decisions\DecisionFactory;
use StepTheFkUp\EasyDecision\Decisions\UnanimousDecision;
use StepTheFkUp\EasyDecision\Exceptions\InvalidArgumentException;
use StepTheFkUp\EasyDecision\Exceptions\InvalidDecisionException;
use StepTheFkUp\EasyDecision\Exceptions\InvalidRuleProviderException;
use StepTheFkUp\EasyDecision\Expressions\ExpressionLanguageConfig;
use StepTheFkUp\EasyDecision\Interfaces\DecisionInterface;
use StepTheFkUp\EasyDecision\Tests\AbstractTestCase;
use StepTheFkUp\EasyDecision\Tests\Stubs\RuleProviderStub;

final class DecisionFactoryTest extends AbstractTestCase
{
    /**
     * Factory should create expected decision with expected rules.
     *
     * @return void
     */
    public function testCreateDecisionSuccessfully(): void
    {
        $mapping = [DecisionInterface::TYPE_YESNO_UNANIMOUS => UnanimousDecision::class];
        $config = new DecisionConfig(
            DecisionInterface::TYPE_YESNO_UNANIMOUS,
            [new RuleProviderStub()],
            new ExpressionLanguageConfig()
        );

        $decision = (new DecisionFactory($mapping, $this->getExpressionLanguageFactory()))->create($config);

        $expected = [
            'true-1' => true,
            'value === 1' => true,
            'value < 2' => true
        ];

        self::assertTrue($decision->make(['value' => 1]));
        self::assertEquals(DecisionInterface::TYPE_YESNO_UNANIMOUS, $decision->getContext()->getDecisionType());
        self::assertEquals($expected, $decision->getContext()->getRuleOutputs());
    }

    /**
     * Factory should throw exception if instantiated decision does not implement DecisionInterface.
     *
     * @return void
     */
    public function testInvalidDecisionInMappingException(): void
    {
        $this->expectException(InvalidDecisionException::class);

        $mapping = ['decision' => \stdClass::class];
        $config = new DecisionConfig('decision', []);

        (new DecisionFactory($mapping, $this->getExpressionLanguageFactory()))->create($config);
    }

    /**
     * Factory should throw an exception if invalid rule provider provided.
     *
     * @return void
     */
    public function testInvalidRuleProviderException(): void
    {
        $this->expectException(InvalidRuleProviderException::class);

        $mapping = [DecisionInterface::TYPE_YESNO_UNANIMOUS => UnanimousDecision::class];
        $config = new DecisionConfig(DecisionInterface::TYPE_YESNO_UNANIMOUS, [new \stdClass()]);

        (new DecisionFactory($mapping, $this->getExpressionLanguageFactory()))->create($config);
    }

    /**
     * Factory should throw exception if given decision type isn't in mapping.
     *
     * @return void
     */
    public function testNotInMappingDecisionException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new DecisionFactory([], $this->getExpressionLanguageFactory()))->create(new DecisionConfig('', []));
    }
}

\class_alias(
    DecisionFactoryTest::class,
    'LoyaltyCorp\EasyDecision\Tests\Decisions\DecisionFactoryTest',
    false
);
