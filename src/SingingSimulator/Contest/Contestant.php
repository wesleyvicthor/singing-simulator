<?php

namespace InnoGames\SingingSimulator\Contest;

use InnoGames\SingingSimulator\Genre\Genre;

class Contestant
{
    private Genre $genre;

    private float $strength;
    private bool $isSick;
    private string $id;

    public function __construct(ContestantId $id, Genre $genre, bool $isSick)
    {
        $this->genre = $genre;
        $this->id = $id;
        $this->strength = $this->generateStrength();
        $this->isSick = $isSick;
        $this->id = $id;
    }

    public function id(): string
    {
        return (string) $this->id;
    }

    public function strength(): float
    {
        if ($this->isSick()) {
            return $this->strength / 2;
        }

        return $this->strength;
    }

    public function genre(): Genre
    {
        return $this->genre;
    }

    public function isSick(): bool
    {
        return $this->isSick;
    }

    private function generateStrength(): float
    {
        $factor = rand(1, 100)/10;
        return (float) rand($this->genre->strengthFactor()*$factor, 1000)/10;
    }
}
