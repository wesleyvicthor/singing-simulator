<?php

namespace InnoGames\SingingSimulator\Contest;

final class Score
{
    private Contestant $contestant;
    private int $score;

    public function __construct(Contestant $contestant, int $score)
    {
        $this->contestant = $contestant;
        $this->score = $score;
    }

    public function contestant(): Contestant
    {
        return $this->contestant;
    }

    public function score(): int
    {
        return $this->score;
    }

    public static function apply(array &$ref, Score $score)
    {
        $id = $score->contestant()->id();
        if (!isset($ref[$id])) {
            $ref[$id] = new Score($score->contestant(), $score->score());

            return;
        }

        $ref[$id] = new Score(
            $ref[$id]->contestant(),
            $ref[$id]->score() + $score->score()
        );
    }
}
