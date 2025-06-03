<?php

namespace App\Rankings\Application\Command;

use App\Rankings\Domain\ValueObject\Points;
use App\Rankings\Domain\ValueObject\UserId;

final class AddPoints
{
    public function __construct(
        public readonly UserId $userId,
        public readonly Points $points
    ) {}
}
