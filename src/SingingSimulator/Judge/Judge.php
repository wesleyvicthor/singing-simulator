<?php

namespace InnoGames\SingingSimulator\Judge;

use InnoGames\SingingSimulator\Contest\Contestant;

interface Judge
{
    public function score(Contestant $contestant): int;
}
