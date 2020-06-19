<?php

namespace InnoGames\SingingSimulator\Contest;

use InnoGames\SingingSimulator\Genre\Genre;
use InnoGames\SingingSimulator\Judge\Judge;

class Round
{
    private Genre $genre;
    
    /**
     * @var Judge[]
     */
    private array $judges;

    private array $result;

    public function __construct(Genre $genre, Judge ...$judges)
    {
        $this->genre = $genre;
        $this->judges = $judges;
        $this->result = [];
    }

    public function run(ContestantId ...$contestantIds)
    {
        foreach($contestantIds as $contestantId) {;
            $contestant = new Contestant(
                $contestantId,
                $this->genre,
                $this->randSickness(count($contestantIds))
            );
            foreach ($this->judges as $judge) {
                Score::apply($this->result, new Score($contestant, $judge->score($contestant)));
            }
        }
    }

    public function genre(): Genre
    {
        return $this->genre;
    }

    /**
     * @return Score[]
     */
    public function result(): array
    {
        return $this->result;
    }

    private function randSickness(int $seed): bool
    {
        $f = rand(1, 100)/10;
        return $seed*$f-($seed*0.05) < 5;
    }
}
