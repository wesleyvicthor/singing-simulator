<?php

namespace InnoGames\Judge;

use InnoGames\Contestant;

/**
 * This judge gives every contestant a score of 8 unless they have a
 * calculated contestant score of less than or equal to 3.0, in which case the `FriendlyJudge` gives a 7.
 * If the contestant is sick, the `FriendlyJudge` awards a bonus point, regardless of calculated contestant score.
 */
class FriendlyJudge implements Judge
{
    public function score(Contestant $contestant): int
    {
        $score = 8;
        if ($contestant->rating() <= 3) {
            $score = 7;
        }

        if ($contestant->isSick()) {
            $score++;
        }

        return $score;
    }
}
