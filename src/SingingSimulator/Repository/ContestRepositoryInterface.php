<?php

namespace InnoGames\SingingSimulator\Repository;

use InnoGames\SingingSimulator\Contest\Winner;

interface ContestRepositoryInterface
{
    public function persistWinners(string $contestId, Winner ...$winners): void;
    public function fetchLastFiveWinners(): array;
    public function fetchTopScoringContestant();
}
