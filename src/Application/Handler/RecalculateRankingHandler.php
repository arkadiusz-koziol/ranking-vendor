<?php

namespace App\Rankings\Application\Handler;

use App\Rankings\Application\Command\RecalculateRanking;
use App\Rankings\Domain\Contract\RankingRepository;
use App\Rankings\Domain\Service\RankingCalculatorLocator;

final class RecalculateRankingHandler
{
    public function __construct(
        private RankingRepository $repository,
        private RankingCalculatorLocator $locator
    ) {}

    public function __invoke(RecalculateRanking $command): void
    {
        $ranking = $this->repository->get($command->rankingId);
        $calculator = $this->locator->for($ranking->type());

        $ranking->recalculate($calculator);

        $this->repository->save($ranking);
    }
}
