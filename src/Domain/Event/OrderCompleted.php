<?php

namespace App\Rankings\Domain\Event;

use App\Rankings\Domain\ValueObject\Money;
use App\Rankings\Domain\ValueObject\UserId;

final class OrderCompleted
{
    public function __construct(
        private UserId $userId,
        private Money $grossAmount,
        private int $itemsCount
    ) {}

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function grossAmount(): Money
    {
        return $this->grossAmount;
    }

    public function itemsCount(): int
    {
        return $this->itemsCount;
    }
}
