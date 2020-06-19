<?php

namespace InnoGames\SingingSimulator\Genre;

abstract class Genre
{
    public function strengthFactor(): int
    {
        return rand(1, 10);
    }

    public function __toString()
    {
        return substr(strrchr(get_class($this), '\\'), 1);
    }
}
