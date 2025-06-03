<?php

namespace App\Rankings\Application\Handler;

use App\Rankings\Application\Command\UpdateManualRanking;
use App\Rankings\Application\DTO\RankingEntryDTO;
use App\Rankings\Domain\Entity\RankingEntry;
use App\Rankings\Domain\Event\ManualRankingUpdated;
use App\Rankings\Domain\ValueObject\RankingId;
use App\Rankings\Domain\Contract\RankingRepository;
use Illuminate\Contracts\Events\Dispatcher;

final class UpdateManualRankingHandler
{
    public function __construct(
        private RankingRepository $repository,
        private Dispatcher $events
    ) {}

    public function __invoke(UpdateManualRanking $command): void
    {
        $ranking = $this->repository->get($command->rankingId);

        $entries = array_map(fn(RankingEntryDTO $dto) => new RankingEntry(
            $dto->userId,
            $dto->position,
            $dto->score
        ), $command->entries);

        $reflection = new \ReflectionClass($ranking);
        $prop = $reflection->getProperty('entries');
        $prop->setAccessible(true);
        $prop->setValue($ranking, $entries);

        $this->repository->save($ranking);

        $this->events->dispatch(new ManualRankingUpdated($command->rankingId));
    }
}
