<?php

namespace InnoGames\SingingSimulator\Judge;

use InnoGames\SingingSimulator\Contest\Contestant;
use InnoGames\SingingSimulator\Identify;

abstract class Judge
{
    use Identify;

    abstract public function score(Contestant $contestant): int;
}
