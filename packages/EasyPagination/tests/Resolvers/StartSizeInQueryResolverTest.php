<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyPagination\Tests\Resolvers;

use StepTheFkUp\EasyPagination\Resolvers\StartSizeInQueryResolver;
use StepTheFkUp\EasyPagination\Tests\AbstractTestCase;

final class StartSizeInQueryResolverTest extends AbstractTestCase
{
    /**
     * StartSizeInQueryResolver should resolve pagination data successfully with custom config.
     *
     * @return void
     */
    public function testCustomConfigResolveSuccessfully(): void
    {
        $config = $this->createConfig('page', null, 'perPage');
        $data = (new StartSizeInQueryResolver($config))->resolve($this->createServerRequest([
            'page' => 5,
            'perPage' => 100
        ]));

        self::assertEquals(5, $data->getStart());
        self::assertEquals(100, $data->getSize());
    }

    /**
     * StartSizeInQueryResolver should resolve pagination data successfully with string values.
     *
     * @return void
     */
    public function testCustomConfigResolveWithStringAsValuesSuccessfully(): void
    {
        $config = $this->createConfig('page', null, 'perPage');
        $data = (new StartSizeInQueryResolver($config))->resolve($this->createServerRequest([
            'page' => '10',
            'perPage' => '50'
        ]));

        self::assertEquals(10, $data->getStart());
        self::assertEquals(50, $data->getSize());
    }

    /**
     * StartSizeInQueryResolver should return data with defaults if query attribute not set.
     *
     * @return void
     */
    public function testDefaultWhenQueryAttrNotSet(): void
    {
        $config = $this->createConfig();
        $data = (new StartSizeInQueryResolver($config))->resolve($this->createServerRequest());

        self::assertEquals($config->getStartDefault(), $data->getStart());
        self::assertEquals($config->getSizeDefault(), $data->getSize());
    }
}

\class_alias(
    StartSizeInQueryResolverTest::class,
    'LoyaltyCorp\EasyPagination\Tests\Resolvers\StartSizeInQueryResolverTest',
    false
);
