<?php

namespace App\Rankings\Domain\ValueObject;

final class UserId
{
    public function __construct(private int $id)
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException(__('User ID must be a positive integer'));
        }
    }

    public function toInt(): int
    {
        return $this->id;
    }

    public function equals(UserId $other): bool
    {
        return $this->id === $other->toInt();
    }
}
