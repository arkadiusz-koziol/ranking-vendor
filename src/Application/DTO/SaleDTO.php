<?php

namespace App\Rankings\Application\DTO;

use App\Rankings\Domain\ValueObject\UserId;
use App\Rankings\Domain\ValueObject\Money;

final class SaleDTO
{
    public function __construct(
        public readonly UserId $userId,
        public readonly Money $grossAmount,
        public readonly int $itemsCount
    ) {}
}
