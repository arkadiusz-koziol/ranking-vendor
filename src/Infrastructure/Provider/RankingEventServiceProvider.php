<?php

namespace App\Rankings\Infrastructure\Provider;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use App\Rankings\Domain\Event\PointsAdded;
use App\Rankings\Domain\Event\OrderCompleted;
use App\Rankings\Infrastructure\Listener\OnPointsAdded;
use App\Rankings\Infrastructure\Listener\OnOrderPaid;

final class RankingEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        PointsAdded::class => [
            OnPointsAdded::class,
        ],
        OrderCompleted::class => [
            OnOrderPaid::class,
        ],
    ];
}
