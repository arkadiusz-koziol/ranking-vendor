<?php

namespace App\Rankings\Application\Command;

use App\Rankings\Domain\ValueObject\Money;
use App\Rankings\Domain\ValueObject\UserId;

final class RecordSale
{
    public function __construct(
        public readonly UserId $userId,
        public readonly Money $grossAmount,
        public readonly int $itemsCount
    ) {}
}
