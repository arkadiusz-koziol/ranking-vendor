<?php

namespace App\Rankings\Infrastructure\Eloquent\Repository;

use App\Rankings\Domain\Aggregate\Ranking;
use App\Rankings\Domain\Contract\RankingRepository;
use App\Rankings\Domain\Entity\RankingEntry;
use App\Rankings\Domain\ValueObject\RankingId;
use App\Rankings\Domain\ValueObject\RankingType;
use App\Rankings\Domain\ValueObject\UserId;
use App\Rankings\Infrastructure\Eloquent\Model\RankingModel;
use App\Rankings\Infrastructure\Eloquent\Model\RankingEntryModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use DateTimeImmutable;

final class EloquentRankingRepository implements RankingRepository
{
    public function save(Ranking $ranking): void
    {
        DB::transaction(function () use ($ranking) {
            $model = RankingModel::updateOrCreate(
                ['id' => $ranking->id()->toString()],
                [
                    'type' => $ranking->type()->value,
                    'name' => $ranking->name(),
                    'calculated_at' => $ranking->calculatedAt(),
                ]
            );

            $model->entries()->delete();

            foreach ($ranking->entries() as $entry) {
                $model->entries()->create([
                    'user_id' => $entry->userId()->toInt(),
                    'position' => $entry->position(),
                    'score' => $entry->score(),
                ]);
            }
        });
    }

    public function get(RankingId $id): Ranking
    {
        $model = RankingModel::with('entries')->where('id', $id->toString())->firstOrFail();

        $entries = $model->entries->map(function ($entry) {
            return new RankingEntry(
                new UserId((int) $entry->user_id),
                (int) $entry->position,
                $entry->score
            );
        })->all();

        return new Ranking(
            new RankingId($model->id),
            RankingType::from($model->type),
            $model->name,
            $entries,
            new DateTimeImmutable($model->calculated_at)
        );
    }

    public function all(): Collection
    {
        return collect(RankingModel::all()->map(function ($model) {
            return new Ranking(
                new RankingId($model->id),
                RankingType::from($model->type),
                $model->name,
                [], // entries not eager loaded
                new DateTimeImmutable($model->calculated_at)
            );
        }));
    }
}
