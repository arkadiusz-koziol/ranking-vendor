<?php

namespace App\Rankings\Infrastructure\Eloquent\Calculator;

use App\Rankings\Domain\Aggregate\Ranking;
use App\Rankings\Domain\Contract\RankingCalculator;
use App\Rankings\Domain\Entity\RankingEntry;
use App\Rankings\Domain\ValueObject\RankingType;
use App\Rankings\Domain\ValueObject\UserId;
use App\Rankings\Domain\ValueObject\Money;

final class SalesRankingCalculator implements RankingCalculator
{
    public function supports(RankingType $type): bool
    {
        return $type === RankingType::SALES;
    }

    /** @return RankingEntry[] */
    public function calculate(Ranking $ranking): array
    {
        // Sample logic – replace with actual data source
        $userSales = [
            [1, 1000.0],
            [2, 800.0],
            [3, 600.0],
        ];

        $entries = [];
        foreach ($userSales as $index => [$userId, $amount]) {
            $entries[] = new RankingEntry(
                new UserId($userId),
                $index + 1,
                new Money($amount)
            );
        }

        return $entries;
    }
}
