<?php

namespace InnoGames\SingingSimulator\Contest;

class Contest
{
    const CONTESTANTS = 10;
    const JUDGES = 3;

    private array $contestantsIds;

    /**
     * @var Round[]
     */
    private array $rounds;

    private array $results;

    public function __construct(ContestantId ...$contestants)
    {
        $this->contestantsIds = $contestants;
    }

    public function addRound(Round $round)
    {
        $this->rounds[] = $round;
    }

    public function progress(): iterable
    {
        foreach ($this->rounds as $round) {
            $round->run(...$this->contestantsIds);

            $this->results[] = $round->result();

            yield $round;
        }
    }

    /**
     * @return Score[]
     */
    public function result(): array
    {
        $finalScore = [];
        foreach ($this->results as $result) {
            foreach ($result as $id => $score) {
                Score::apply($finalScore, new Score($score->contestant(), $score->score()));
            }
        }

        return $finalScore;
    }

    /**
     * @return Score[]
     */
    public function winners(): array
    {
        $result = $this->result();
        $scores = array_map(fn($i) => $i->score(), $result);
        $tieScore = 0;
        foreach(array_count_values($scores) as $score => $count) {
            if ($count > 1 && $score > $tieScore) {
                $tieScore = $score;
            }
        }

        $winners = [];
        $winnerScore = max($scores);
        if ($winnerScore == $tieScore) {
            foreach ($result as $score) {
                if ($score->score() == $tieScore) {
                    $winners[] = new Winner($score);
                }
            }

            return $winners;
        }

        foreach($result as $score) {
            if ($score->score() == $winnerScore) {
                return [new Winner($score)];
            }
        }
    }
}
