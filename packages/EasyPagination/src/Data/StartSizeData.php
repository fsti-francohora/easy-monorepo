<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyPagination\Data;

use StepTheFkUp\EasyPagination\Interfaces\StartSizeDataInterface;

final class StartSizeData implements StartSizeDataInterface
{
    /**
     * @var int
     */
    private $size;

    /**
     * @var int
     */
    private $start;

    /**
     * StartSizeData constructor.
     *
     * @param int $start
     * @param int $size
     */
    public function __construct(int $start, int $size)
    {
        $this->start = $start;
        $this->size = $size;
    }

    /**
     * Get size.
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Get start.
     *
     * @return int
     */
    public function getStart(): int
    {
        return $this->start;
    }
}

\class_alias(
    StartSizeData::class,
    'LoyaltyCorp\EasyPagination\Data\StartSizeData',
    false
);
