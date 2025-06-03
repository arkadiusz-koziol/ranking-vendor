<?php

namespace App\Rankings\Application\Command;

use App\Rankings\Application\DTO\RankingEntryDTO;
use App\Rankings\Domain\ValueObject\RankingId;

final class UpdateManualRanking
{
    /** @param RankingEntryDTO[] $entries */
    public function __construct(
        public readonly RankingId $rankingId,
        public readonly array $entries
    ) {}
}
