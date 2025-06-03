<?php

namespace App\Rankings\Domain\Event;

use App\Rankings\Domain\ValueObject\Points;
use App\Rankings\Domain\ValueObject\UserId;

final class PointsAdded
{
    public function __construct(
        private UserId $userId,
        private Points $points
    ) {}

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function points(): Points
    {
        return $this->points;
    }
}
