<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyRepository\Tests\Bridge\Laravel;

use StepTheFkUp\EasyRepository\Bridge\Laravel\EasyRepositoryProvider;
use StepTheFkUp\EasyRepository\Bridge\Laravel\Exceptions\EmptyRepositoriesListException;
use StepTheFkUp\EasyRepository\Tests\AbstractLumenTestCase;
use StepTheFkUp\EasyRepository\Tests\Bridge\Laravel\Stubs\Repository1Stub;
use StepTheFkUp\EasyRepository\Tests\Bridge\Laravel\Stubs\Repository2Stub;

final class EasyRepositoryProviderTest extends AbstractLumenTestCase
{
    /**
     * Provider should throw exception when no repositories to register.
     *
     * @return void
     *
     * @throws \StepTheFkUp\EasyRepository\Bridge\Laravel\Exceptions\EmptyRepositoriesListException
     */
    public function testEmptyRepositoriesListException(): void
    {
        $this->expectException(EmptyRepositoriesListException::class);

        /** @var \Illuminate\Contracts\Foundation\Application $app */
        $app = $this->getApplication();

        (new EasyRepositoryProvider($app))->register();
    }

    /**
     * Provider should call the application to bind all the repositories with their interfaces.
     *
     * @return void
     *
     * @throws \StepTheFkUp\EasyRepository\Bridge\Laravel\Exceptions\EmptyRepositoriesListException
     */
    public function testRegisterRepositoriesSuccessfully(): void
    {
        $app = $this->getApplication();
        \config()->set('easy-repository.repositories', [
            'interface-1' => Repository1Stub::class,
            'interface-2' => Repository2Stub::class
        ]);

        /** @var \Illuminate\Contracts\Foundation\Application $app */
        $provider = new EasyRepositoryProvider($app);
        $provider->boot();
        $provider->register();

        $this->assertInstanceInApp(Repository1Stub::class, 'interface-1');
        $this->assertInstanceInApp(Repository2Stub::class, 'interface-2');
    }
}

\class_alias(
    EasyRepositoryProviderTest::class,
    'LoyaltyCorp\EasyRepository\Tests\Bridge\Laravel\EasyRepositoryProviderTest',
    false
);
