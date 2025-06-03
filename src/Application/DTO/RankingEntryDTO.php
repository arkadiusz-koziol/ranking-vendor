<?php

namespace App\Rankings\Application\DTO;

use App\Rankings\Domain\ValueObject\UserId;

final class RankingEntryDTO
{
    public function __construct(
        public readonly UserId $userId,
        public readonly int $position,
        public readonly mixed $score
    ) {}
}
