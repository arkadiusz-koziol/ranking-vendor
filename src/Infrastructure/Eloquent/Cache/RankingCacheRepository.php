<?php

namespace App\Rankings\Infrastructure\Eloquent\Cache;

use App\Rankings\Domain\Aggregate\Ranking;
use App\Rankings\Domain\Contract\RankingRepository;
use App\Rankings\Domain\ValueObject\RankingId;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Collection;

final class RankingCacheRepository implements RankingRepository
{
    public function __construct(
        private RankingRepository $inner,
        private Cache $cache
    ) {}

    public function save(Ranking $ranking): void
    {
        $this->inner->save($ranking);
        $this->cache->put($this->cacheKey($ranking->id()), $ranking);
    }

    public function get(RankingId $id): Ranking
    {
        return $this->cache->remember(
            $this->cacheKey($id),
            now()->addMinutes(10),
            fn () => $this->inner->get($id)
        );
    }

    public function all(): Collection
    {
        return $this->inner->all();
    }

    private function cacheKey(RankingId $id): string
    {
        return 'ranking:' . $id->toString();
    }
}
