<?php

namespace App\Rankings\Domain\ValueObject;

use Ramsey\Uuid\Uuid;

final class RankingId
{
    public function __construct(private string $id)
    {
        if (!Uuid::isValid($id)) {
            throw new \InvalidArgumentException(__('Invalid UUID for RankingId'));
        }
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function toString(): string
    {
        return $this->id;
    }

    public function equals(RankingId $other): bool
    {
        return $this->id === $other->toString();
    }
}
