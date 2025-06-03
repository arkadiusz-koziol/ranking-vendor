<?php

namespace App\Rankings\Infrastructure\Eloquent\Calculator;

use App\Rankings\Domain\Aggregate\Ranking;
use App\Rankings\Domain\Contract\RankingCalculator;
use App\Rankings\Domain\Entity\RankingEntry;
use App\Rankings\Domain\ValueObject\RankingType;
use App\Rankings\Domain\ValueObject\UserId;
use App\Rankings\Domain\ValueObject\Points;

final class PointsRankingCalculator implements RankingCalculator
{
    public function supports(RankingType $type): bool
    {
        return $type === RankingType::POINTS;
    }

    /** @return RankingEntry[] */
    public function calculate(Ranking $ranking): array
    {
        // Sample logic – replace with actual data source
        $usersPoints = [
            [1, 150],
            [2, 120],
            [3, 90],
        ];

        $entries = [];
        foreach ($usersPoints as $index => [$userId, $points]) {
            $entries[] = new RankingEntry(
                new UserId($userId),
                $index + 1,
                new Points($points)
            );
        }

        return $entries;
    }
}
