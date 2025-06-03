<?php

namespace App\Rankings\Domain\Event;

use App\Rankings\Domain\ValueObject\RankingId;

final class ManualRankingUpdated
{
    public function __construct(private RankingId $rankingId) {}

    public function rankingId(): RankingId
    {
        return $this->rankingId;
    }
}
