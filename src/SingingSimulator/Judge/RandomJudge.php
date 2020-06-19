<?php

namespace InnoGames\SingingSimulator\Judge;

use InnoGames\SingingSimulator\Contest\Contestant;

/**
 * This judge gives a random score out of 10, regardless of the calculated contestant score.
 */
class RandomJudge extends Judge
{
    public function score(Contestant $contestant): int
    {
        return rand(1, 10);
    }
}
