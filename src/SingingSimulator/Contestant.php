<?php

namespace InnoGames;

use InnoGames\Genre\Genre;

class Contestant
{
    private Genre $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function getId(): string
    {
        $pref = implode('', array_rand(array_flip(range('A', 'Z')), 2));

        return strtoupper(uniqid($pref));
    }

    // once calculated when created, move to constructor
    public function rating(): float
    {
        $factor = rand(1, 10)/10;
        return (float) rand($this->strength()*$factor, 1000)/10;
    }

    public function strength(): int
    {
        return rand(1, 10);
    }

    public function genre(): Genre
    {
        return $this->genre;
    }

    public function isSick(): bool
    {
        return false;
    }
}
