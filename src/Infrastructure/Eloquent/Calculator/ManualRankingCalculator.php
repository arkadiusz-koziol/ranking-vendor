<?php

namespace App\Rankings\Infrastructure\Eloquent\Calculator;

use App\Rankings\Domain\Aggregate\Ranking;
use App\Rankings\Domain\Contract\RankingCalculator;
use App\Rankings\Domain\Entity\RankingEntry;
use App\Rankings\Domain\ValueObject\RankingType;

final class ManualRankingCalculator implements RankingCalculator
{
    public function supports(RankingType $type): bool
    {
        return $type === RankingType::MANUAL;
    }

    /** @return RankingEntry[] */
    public function calculate(Ranking $ranking): array
    {
        return $ranking->entries();
    }
}
