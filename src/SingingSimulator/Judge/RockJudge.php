<?php

namespace InnoGames\SingingSimulator\Judge;

use InnoGames\SingingSimulator\Contest\Contestant;
use InnoGames\SingingSimulator\Genre\Rock;

/**
 * This judge's favourite genre is `Rock`. For any other genre, the `RockJudge` gives a random integer score
 * out of 10, regardless of the calculated contestant score.
 * For the `Rock` genre, this judge gives a score based on the calculated contestant score
 * less than 50.0 results in a judge score of 5, 50.0 to 74.9 results in an 8,
 * while 75 and above results in a 10.
 */
class RockJudge extends Judge
{
    public function score(Contestant $contestant): int
    {
        if (!$contestant->genre() instanceof Rock) {
            return rand(1, 10);
        }

        $strength = $contestant->strength();
        if ($strength < 50) {
            return 5;
        }

        if ($strength >= 50 && $strength <= 74.9) {
            return 8;
        }

        return 10;
    }
}
