<?php

namespace InnoGames\SingingSimulator\Contest;

class ContestantId
{
    private string $id;

    public function __construct(string $ref)
    {
        $this->id = sprintf("%s.%s", $ref, $this->generateId());
    }

    private function generateId(): string
    {
        return strtoupper(
            implode('', array_rand(array_flip(range('A', 'Z')), 2)).substr(uniqid(), -3, 3)
        );
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
