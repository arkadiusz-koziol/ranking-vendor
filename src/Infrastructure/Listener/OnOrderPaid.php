<?php

namespace App\Rankings\Infrastructure\Listener;

use App\Rankings\Domain\Event\OrderCompleted;
use App\Rankings\Application\Command\RecalculateRanking;
use App\Rankings\Domain\ValueObject\RankingId;
use Illuminate\Contracts\Bus\Dispatcher;

final class OnOrderPaid
{
    public function __construct(private Dispatcher $bus) {}

    public function handle(OrderCompleted $event): void
    {
        $this->bus->dispatch(
            new RecalculateRanking(RankingId::from(config('rankings.ids.sales')))
        );
    }
}
