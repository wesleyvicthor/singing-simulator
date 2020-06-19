<?php

namespace InnoGames\SingingSimulator\Genre;

use InnoGames\SingingSimulator\Identify;

abstract class Genre
{
    use Identify;

    public function strengthFactor(): int
    {
        return rand(1, 10);
    }
}
