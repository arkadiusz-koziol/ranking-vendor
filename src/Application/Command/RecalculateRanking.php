<?php

namespace App\Rankings\Application\Command;

use App\Rankings\Domain\ValueObject\RankingId;

final class RecalculateRanking
{
    public function __construct(public readonly RankingId $rankingId) {}
}
