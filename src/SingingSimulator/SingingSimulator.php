<?php

namespace InnoGames;

use InnoGames\Genre\Country;
use InnoGames\Genre\Disco;
use InnoGames\Genre\Jazz;
use InnoGames\Genre\Pop;
use InnoGames\Genre\Rock;
use InnoGames\Genre\TheBlues;
use InnoGames\Judge\FriendlyJudge;
use InnoGames\Judge\HonestJudge;
use InnoGames\Judge\MeanJudge;
use InnoGames\Judge\RandomJudge;
use InnoGames\Judge\RockJudge;

class SingingSimulator
{
    public function start()
    {
        $genres = [
            new Rock(),
            new Disco(),
            new Jazz(),
            new TheBlues(),
            new Pop(),
            new Country(),
        ];

        $judges = [
            new MeanJudge(),
            new RockJudge(),
            new HonestJudge(),
            new RandomJudge(),
            new FriendlyJudge(),
        ];


//        $contest = new Contest();
//        has rounds
//        has a winner

        $r = [];
        foreach ($genres as $genre) {
            $round = new Round($genre, ...array_map(fn($k) => $judges[$k], array_rand($judges, 3)));

            $round->run();
            $r[] = $round;
        }

        var_dump($r);
    }

    public function round()
    {

    }
}
