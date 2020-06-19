<?php

namespace InnoGames\SingingSimulator\Contest;

final class Winner
{
    private Contestant $contestant;
    private int $score;

    public function __construct(Score $score)
    {
        $this->contestant = $score->contestant();
        $this->score = $score->score();
    }

    public function contestant(): Contestant
    {
        return $this->contestant;
    }

    public function score(): int
    {
        return $this->score;
    }
}
