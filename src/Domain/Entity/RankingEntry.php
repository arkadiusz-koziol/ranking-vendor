<?php

namespace App\Rankings\Domain\Entity;

use App\Rankings\Domain\ValueObject\UserId;

final class RankingEntry
{
    public function __construct(
        private UserId $userId,
        private int $position,
        private mixed $score,
    ) {}

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function position(): int
    {
        return $this->position;
    }

    public function score(): mixed
    {
        return $this->score;
    }
}
