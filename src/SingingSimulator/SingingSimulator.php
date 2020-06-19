<?php

namespace InnoGames\SingingSimulator;

use InnoGames\SingingSimulator\Contest\Contest;
use InnoGames\SingingSimulator\Contest\ContestantId;
use InnoGames\SingingSimulator\Contest\Round;
use InnoGames\SingingSimulator\Genre\Country;
use InnoGames\SingingSimulator\Genre\Disco;
use InnoGames\SingingSimulator\Genre\Jazz;
use InnoGames\SingingSimulator\Genre\Pop;
use InnoGames\SingingSimulator\Genre\Rock;
use InnoGames\SingingSimulator\Genre\TheBlues;
use InnoGames\SingingSimulator\Judge\FriendlyJudge;
use InnoGames\SingingSimulator\Judge\HonestJudge;
use InnoGames\SingingSimulator\Judge\MeanJudge;
use InnoGames\SingingSimulator\Judge\RandomJudge;
use InnoGames\SingingSimulator\Judge\RockJudge;

class SingingSimulator
{
    const CONTESTANTS = 10;

    public function start(): Contest
    {
        $contest = new Contest(...array_map(fn($ref) => new ContestantId($ref), range(1, self::CONTESTANTS)));
        $judges = $this->judges();
        foreach ($this->genres() as $genre) {
            $round = new Round(
                $genre,
                ...array_map(fn($k) => $judges[$k], array_rand($judges, 3))
            );

            $contest->addRound($round);
        }

        return $contest;
    }

    private function judges()
    {
        return [
            new MeanJudge(),
            new RockJudge(),
            new HonestJudge(),
            new RandomJudge(),
            new FriendlyJudge(),
        ];
    }

    private function genres(): array
    {
        return [
            new Rock(),
            new Disco(),
            new Jazz(),
            new TheBlues(),
            new Pop(),
            new Country(),
        ];
    }
}
