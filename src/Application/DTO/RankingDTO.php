<?php

namespace App\Rankings\Application\DTO;

use App\Rankings\Domain\ValueObject\RankingId;
use App\Rankings\Domain\ValueObject\RankingType;
use DateTimeImmutable;

final class RankingDTO
{
    /** @param RankingEntryDTO[] $entries */
    public function __construct(
        public readonly RankingId $id,
        public readonly RankingType $type,
        public readonly string $name,
        public readonly array $entries,
        public readonly DateTimeImmutable $calculatedAt
    ) {}
}
