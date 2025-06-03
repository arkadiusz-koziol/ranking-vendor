<?php

namespace App\Rankings\Application\Handler;

use App\Rankings\Application\Command\RecordSale;
use App\Rankings\Domain\Event\OrderCompleted;
use Illuminate\Contracts\Events\Dispatcher;

final class RecordSaleHandler
{
    public function __construct(private Dispatcher $events) {}

    public function __invoke(RecordSale $command): void
    {
        $this->events->dispatch(new OrderCompleted(
            $command->userId,
            $command->grossAmount,
            $command->itemsCount
        ));
    }
}
