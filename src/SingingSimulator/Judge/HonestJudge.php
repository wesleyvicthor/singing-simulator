<?php

namespace InnoGames\Judge;

use InnoGames\Contestant;

/**
 * This judge converts the calculated contestant score evenly using the following table:
 * ||Calculate Score Range||Judge Score||
 * |     0.1 - 10.0        |      1     |
 * |    10.1 - 20.0        |      2     |
 * |    20.1 - 30.0        |      3     |
 * |    30.1 - 40.0        |      4     |
 * |    40.1 - 50.0        |      5     |
 * |    50.1 - 60.0        |      6     |
 * |    60.1 - 70.0        |      7     |
 * |    70.1 - 80.0        |      8     |
 * |    80.1 - 90.0        |      9     |
 * |    90.1 - 100.0       |     10     |
 * -
 */
class HonestJudge implements Judge
{
    private $ranges = [
        1 => [0, 10],
        2 => [10, 20],
        3 => [20, 30],
        4 => [30, 40],
        5 => [40, 50],
        6 => [50, 60],
        7 => [60, 70],
        8 => [70, 80],
        9 => [80, 90],
        10 => [90, 100],
    ];

    public function score(Contestant $contestant): int
    {
        $rating = $contestant->rating();
        foreach ($this->ranges as $score => $range) {
            if ($rating > $range[0] && $rating <= $range[1]) {
                return $score;
            }
        }
    }
}
