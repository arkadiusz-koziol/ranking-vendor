<?php

namespace App\Rankings;

use Illuminate\Support\ServiceProvider;
use App\Rankings\Domain\Contract\RankingRepository;
use App\Rankings\Domain\Service\RankingCalculatorLocator;
use App\Rankings\Infrastructure\Eloquent\Repository\EloquentRankingRepository;
use App\Rankings\Infrastructure\Eloquent\Cache\RankingCacheRepository;
use Illuminate\Contracts\Cache\Repository as Cache;
use App\Rankings\Domain\Contract\RankingCalculator;

final class LaravelRankingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/Config/rankings.php', 'rankings');
        $this->app->singleton(RankingRepository::class, function ($app) {
            return new RankingCacheRepository(
                new EloquentRankingRepository(),
                $app->make(Cache::class)
            );
        });

        $this->app->singleton(RankingCalculatorLocator::class, function ($app) {
            $calculatorClasses = $app['config']->get('rankings.calculators', []);

            $calculators = array_map(fn (string $c) => $app->make($c), $calculatorClasses);

            return new RankingCalculatorLocator($calculators);
        });

        foreach ($this->app['config']->get('rankings.calculators', []) as $calculator) {
            $this->app->bind($calculator, $calculator);
        }
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/Config/rankings.php' => config_path('rankings.php'),
            ], 'config');

            $this->loadMigrationsFrom(__DIR__.'/Infrastructure/Migration');
        }
    }
}
