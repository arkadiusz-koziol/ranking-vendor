<?php

use App\Rankings\Infrastructure\Eloquent\Calculator\{
    PointsRankingCalculator,
    SalesRankingCalculator,
    ManualRankingCalculator
};

return [
    'calculators' => [
        PointsRankingCalculator::class,
        SalesRankingCalculator::class,
        ManualRankingCalculator::class,
    ],

    'ids' => [
        'points' => 'uuid-points-ranking-id',
        'sales' => 'uuid-sales-ranking-id',
    ],
];
