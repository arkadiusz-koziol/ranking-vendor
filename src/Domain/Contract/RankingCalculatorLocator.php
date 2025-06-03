<?php

namespace App\Rankings\Domain\Service;

use App\Rankings\Domain\Contract\RankingCalculator;
use App\Rankings\Domain\ValueObject\RankingType;
use InvalidArgumentException;

final class RankingCalculatorLocator
{
    /** @param RankingCalculator[] $calculators */
    public function __construct(private array $calculators) {}

    public function for(RankingType $type): RankingCalculator
    {
        foreach ($this->calculators as $calculator) {
            if ($calculator->supports($type)) {
                return $calculator;
            }
        }

        throw new InvalidArgumentException(__('No calculator supports this ranking type'));
    }
}
