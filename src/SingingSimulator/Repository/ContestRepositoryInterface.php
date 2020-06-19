<?php

namespace InnoGames\Repository;

use InnoGames\SingingSimulator\Contest\Winner;

interface ContestRepositoryInterface
{
    public function persistWinners(Winner ...$winners);
}
