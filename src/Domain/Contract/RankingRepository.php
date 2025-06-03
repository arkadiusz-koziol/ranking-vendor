<?php

namespace App\Rankings\Domain\Contract;

use App\Rankings\Domain\Aggregate\Ranking;
use App\Rankings\Domain\ValueObject\RankingId;
use Illuminate\Support\Collection;

interface RankingRepository
{
    public function save(Ranking $ranking): void;

    public function get(RankingId $id): Ranking;

    /** @return Collection<Ranking> */
    public function all(): Collection;
}
