<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyPagination\Tests\Bridge\Laravel;

use Illuminate\Pagination\LengthAwarePaginator as IlluminateLengthAwarePaginator;
use StepTheFkUp\EasyPagination\Bridge\Laravel\LengthAwarePaginator;
use StepTheFkUp\EasyPagination\Tests\AbstractTestCase;

class LengthAwarePaginatorTest extends AbstractTestCase
{
    /**
     * Paginator should return expected output data based on input data.
     *
     * @return void
     */
    public function testGetters(): void
    {
        $items = [];
        $page = 1;
        $perPage = 15;
        $total = 100;

        $paginator = new LengthAwarePaginator(new IlluminateLengthAwarePaginator($items, $total, $perPage, $page));

        self::assertEquals($page, $paginator->getCurrentPage());
        self::assertEquals($items, $paginator->getItems());
        self::assertEquals($perPage, $paginator->getItemsPerPage());
        self::assertEquals($total, $paginator->getTotalItems());
        self::assertEquals(7, $paginator->getTotalPages());
        self::assertTrue($paginator->hasNextPage());
        self::assertFalse($paginator->hasPreviousPage());
    }
}

\class_alias(
    LengthAwarePaginatorTest::class,
    'LoyaltyCorp\EasyPagination\Tests\Bridge\Laravel\LengthAwarePaginatorTest',
    false
);
