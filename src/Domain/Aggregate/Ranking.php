<?php

namespace App\Rankings\Domain\Aggregate;

use App\Rankings\Domain\Contract\RankingCalculator;
use App\Rankings\Domain\Entity\RankingEntry;
use App\Rankings\Domain\Event\RankingRecalculated;
use App\Rankings\Domain\ValueObject\RankingId;
use App\Rankings\Domain\ValueObject\RankingType;
use DateTimeImmutable;

final class Ranking
{
    /** @param RankingEntry[] $entries */
    public function __construct(
        private RankingId $id,
        private RankingType $type,
        private string $name,
        private array $entries = [],
        private DateTimeImmutable $calculatedAt = new DateTimeImmutable(),
    ) {}

    public function recalculate(RankingCalculator $calculator): void
    {
        $this->entries = $calculator->calculate($this);
        $this->calculatedAt = new DateTimeImmutable();
        $this->recordEvent(new RankingRecalculated($this->id));
    }

    public function id(): RankingId
    {
        return $this->id;
    }

    public function type(): RankingType
    {
        return $this->type;
    }

    public function name(): string
    {
        return $this->name;
    }

    /** @return RankingEntry[] */
    public function entries(): array
    {
        return $this->entries;
    }

    public function calculatedAt(): DateTimeImmutable
    {
        return $this->calculatedAt;
    }

    private function recordEvent(object $event): void
    {
        // Event recording logic to be implemented via trait or event recorder
    }
}
