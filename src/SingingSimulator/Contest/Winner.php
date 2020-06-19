<?php

namespace InnoGames\SingingSimulator\Contest;

final class Winner
{
    private Contestant $contestant;
    private int $score;

    public function __construct(Contestant $contestant, int $score)
    {
        $this->contestant = $contestant;
        $this->score = $score;
    }

    public function contestant()
    {
        return $this->contestant;
    }

    public function score()
    {
        return $this->score;
    }

    public function betterThan(Winner $winner): bool
    {
        return $this->score() > $winner->score();
    }
}
