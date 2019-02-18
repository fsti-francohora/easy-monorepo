<?php
declare(strict_types=1);

namespace StepTheFkUp\ApiFilters\Mapping;

use StepTheFkUp\ApiFilters\Interfaces\Mapping\DefaultsInterface;
use StepTheFkUp\ApiFilters\Mapping\Filters\BooleanFilter;
use StepTheFkUp\ApiFilters\Mapping\Filters\DateFilter;
use StepTheFkUp\ApiFilters\Mapping\Filters\NumberFilter;
use StepTheFkUp\ApiFilters\Mapping\Filters\OrderFilter;
use StepTheFkUp\ApiFilters\Mapping\Filters\StringFilter;
use StepTheFkUp\ApiFilters\Mapping\Options\Booleans\IsFalseOption;
use StepTheFkUp\ApiFilters\Mapping\Options\Booleans\IsTrueOption;
use StepTheFkUp\ApiFilters\Mapping\Options\Dates\Absolutes\AfterOption;
use StepTheFkUp\ApiFilters\Mapping\Options\Dates\Absolutes\BeforeOption;
use StepTheFkUp\ApiFilters\Mapping\Options\Dates\Absolutes\OnOption;
use StepTheFkUp\ApiFilters\Mapping\Options\Dates\Relatives\ExactlyOption;
use StepTheFkUp\ApiFilters\Mapping\Options\Dates\Relatives\LessThanOption;
use StepTheFkUp\ApiFilters\Mapping\Options\Dates\Relatives\MoreThanOption;
use StepTheFkUp\ApiFilters\Mapping\Options\HasAnyValueOption;
use StepTheFkUp\ApiFilters\Mapping\Options\InOption;
use StepTheFkUp\ApiFilters\Mapping\Options\IsNotOption;
use StepTheFkUp\ApiFilters\Mapping\Options\IsOption;
use StepTheFkUp\ApiFilters\Mapping\Options\IsUnknownOption;
use StepTheFkUp\ApiFilters\Mapping\Options\Numbers\GreaterThanOption;
use StepTheFkUp\ApiFilters\Mapping\Options\Numbers\LowerThanOption;
use StepTheFkUp\ApiFilters\Mapping\Options\OrderDirectionOption;
use StepTheFkUp\ApiFilters\Mapping\Options\SelectOption;
use StepTheFkUp\ApiFilters\Mapping\Options\Strings\ContainsOption;
use StepTheFkUp\ApiFilters\Mapping\Options\Strings\DoesNotContainOption;
use StepTheFkUp\ApiFilters\Mapping\Options\Strings\EndsWithOption;
use StepTheFkUp\ApiFilters\Mapping\Options\Strings\StartsWithOption;

final class Defaults implements DefaultsInterface
{
    /**
     * Get default filters aliases list.
     *
     * @return string[]
     */
    public function getFilterAliases(): array
    {
        return [
            'boolean' => BooleanFilter::class,
            'bool' => BooleanFilter::class,
            'int' => NumberFilter::class,
            'integer' => NumberFilter::class,
            'float' => NumberFilter::class,
            'order' => OrderFilter::class,
            'sort' => OrderFilter::class,
            'string' => StringFilter::class
        ];
    }

    /**
     * Get default filters default options list.
     *
     * @return string[]
     */
    public function getFilterDefaultOptions(): array
    {
        return [
            BooleanFilter::class => [
                IsFalseOption::class,
                IsTrueOption::class,
                IsUnknownOption::class,
                HasAnyValueOption::class
            ],
            DateFilter::class => [
                MoreThanOption::class,
                ExactlyOption::class,
                LessThanOption::class,
                AfterOption::class,
                OnOption::class,
                BeforeOption::class,
                IsUnknownOption::class,
                HasAnyValueOption::class
            ],
            NumberFilter::class => [
                GreaterThanOption::class,
                LowerThanOption::class,
                IsOption::class,
                IsNotOption::class,
                IsUnknownOption::class,
                HasAnyValueOption::class
            ],
            OrderFilter::class => [
                OrderDirectionOption::class
            ],
            StringFilter::class => [
                IsOption::class,
                IsNotOption::class,
                StartsWithOption::class,
                EndsWithOption::class,
                ContainsOption::class,
                DoesNotContainOption::class,
                IsUnknownOption::class,
                HasAnyValueOption::class
            ]
        ];
    }

    /**
     * Get default filters classes list.
     *
     * @return string[]
     */
    public function getFilters(): array
    {
        return [
            BooleanFilter::class,
            DateFilter::class,
            NumberFilter::class,
            OrderFilter::class,
            StringFilter::class
        ];
    }

    /**
     * Get default options aliases list.
     *
     * @return string[]
     */
    public function getOptionAliases(): array
    {
        return [
            'false' => IsFalseOption::class,
            'is_false' => IsFalseOption::class,
            'true' => IsTrueOption::class,
            'is_true' => IsTrueOption::class,
            'after' => AfterOption::class,
            'before' => BeforeOption::class,
            'on' => OnOption::class,
            'exactly' => ExactlyOption::class,
            'less_than' => LessThanOption::class,
            'more_than' => MoreThanOption::class,
            'greater_than' => GreaterThanOption::class,
            'lower_than' => LowerThanOption::class,
            'contains' => ContainsOption::class,
            'not_contains' => DoesNotContainOption::class,
            'ends_with' => EndsWithOption::class,
            'starts_with' => StartsWithOption::class,
            'any' => HasAnyValueOption::class,
            'has_any' => HasAnyValueOption::class,
            'in' => InOption::class,
            'is_not' => IsNotOption::class,
            'is' => IsOption::class,
            'unknown' => IsUnknownOption::class,
            'select' => SelectOption::class
        ];
    }

    /**
     * Get default options classes list.
     *
     * @return string[]
     */
    public function getOptions(): array
    {
        return [
            // Booleans
            IsFalseOption::class,
            IsTrueOption::class,
            // Dates - Absolutes
            AfterOption::class,
            BeforeOption::class,
            OnOption::class,
            // Dates - Relatives
            ExactlyOption::class,
            LessThanOption::class,
            MoreThanOption::class,
            // Numbers
            GreaterThanOption::class,
            LowerThanOption::class,
            // Orders
            OrderDirectionOption::class,
            // Strings
            ContainsOption::class,
            DoesNotContainOption::class,
            EndsWithOption::class,
            StartsWithOption::class,
            // All
            HasAnyValueOption::class,
            InOption::class,
            IsNotOption::class,
            IsOption::class,
            IsUnknownOption::class,
            SelectOption::class
        ];
    }
}
