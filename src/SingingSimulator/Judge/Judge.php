<?php

namespace InnoGames\Judge;

use InnoGames\Contestant;

interface Judge
{
    public function score(Contestant $contestant): int;
}
