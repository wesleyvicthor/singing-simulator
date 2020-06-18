<?php

namespace InnoGames\Judge;

use InnoGames\Contestant;

/**
 * This judge gives every contestant with a calculated contestant score less than 90.0
 * a judge score of 2. Any contestant scoring 90.0 or more instead receives a 10.
 */
class MeanJudge implements Judge
{
    private const AVG_MEAN = 90;

    public function score(Contestant $contestant): int
    {
        if ($contestant->rating() < self::AVG_MEAN) {
            return 2;
        }

        return 10;
    }
}
