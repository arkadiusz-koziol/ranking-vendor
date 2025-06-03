<?php

namespace App\Rankings\Domain\Contract;

use App\Rankings\Domain\Aggregate\Ranking;
use App\Rankings\Domain\Entity\RankingEntry;
use App\Rankings\Domain\ValueObject\RankingType;

interface RankingCalculator
{
    public function supports(RankingType $type): bool;

    /** @return RankingEntry[] */
    public function calculate(Ranking $ranking): array;
}
