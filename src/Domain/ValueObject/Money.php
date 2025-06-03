<?php

namespace App\Rankings\Domain\ValueObject;

use InvalidArgumentException;

final class Money
{
    public function __construct(private float $amount)
    {
        if ($amount < 0) {
            throw new InvalidArgumentException(__('Amount must be non-negative'));
        }
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function add(Money $other): self
    {
        return new self($this->amount + $other->amount());
    }

    public function equals(Money $other): bool
    {
        return $this->amount === $other->amount();
    }
}
