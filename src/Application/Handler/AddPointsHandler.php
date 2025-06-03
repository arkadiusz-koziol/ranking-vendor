<?php

namespace App\Rankings\Application\Handler;

use App\Rankings\Application\Command\AddPoints;
use App\Rankings\Domain\Event\PointsAdded;
use Illuminate\Contracts\Events\Dispatcher;

final class AddPointsHandler
{
    public function __construct(private Dispatcher $events) {}

    public function __invoke(AddPoints $command): void
    {
        $this->events->dispatch(new PointsAdded($command->userId, $command->points));
    }
}
