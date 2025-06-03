<?php

namespace App\Rankings\Domain\ValueObject;

final class Points
{
    public function __construct(private int $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException(__('Points value must be non-negative'));
        }
    }

    public function value(): int
    {
        return $this->value;
    }

    public function add(Points $other): self
    {
        return new self($this->value + $other->value());
    }

    public function equals(Points $other): bool
    {
        return $this->value === $other->value();
    }
}
