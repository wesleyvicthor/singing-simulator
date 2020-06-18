<?php

namespace InnoGames;

use InnoGames\Genre\Genre;
use InnoGames\Judge\Judge;
use SplObjectStorage;

class Round
{
    private Genre $genre;
    
    /**
     * @var Judge[]
     */
    private array $judges;

    private SplObjectStorage $result;

    public function __construct(Genre $genre, Judge ...$judges)
    {
        $this->genre = $genre;
        $this->judges = $judges;
        $this->result = new SplObjectStorage();
    }

    public function run($ncontestants = 10)
    {
        while($ncontestants--) {
            $contestant = new Contestant($this->genre);
            foreach ($this->judges as $judge) {
                if (!$this->result->contains($contestant)) {
                    $this->result[$contestant] = $judge->score($contestant);

                    continue;
                }

                $this->result[$contestant] += $judge->score($contestant);
            }
        }
    }

    public function result(): SplObjectStorage
    {
        return $this->result;
    }
}
