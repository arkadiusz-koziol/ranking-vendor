<?php

namespace App\Rankings\Domain\ValueObject;

enum RankingType: string
{
    case POINTS = 'points';
    case SALES = 'sales';
    case MANUAL = 'manual';

    public function label(): string
    {
        return match ($this) {
            self::POINTS => __('Points Ranking'),
            self::SALES => __('Sales Ranking'),
            self::MANUAL => __('Manual Ranking'),
        };
    }
}
