<?php

namespace InnoGames\SingingSimulator\Contest;

class Contest
{
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

    public function winners(): array
    {
        $result = $this->result();
        $tieScore = 0;
        foreach(array_count_values($result) as $score => $count) {
            if ($count > 1 && $score > $tieScore) {
                $tieScore = $score;
            }
        }

        $winnerScore = 0;
        $winnerId = null;
        foreach ($result as $id => $score) {
            if ($score > $winnerScore) {
                $winnerScore = $score;
                $winnerId = $id;
            }
        }

        $winners = [];
        if ($winnerScore == $tieScore) {
            foreach ($result as $id => $score) {
                if ($score == $tieScore) {
                    $winners[] = [$id, $score];
                }
            }
        }

        return empty($winners) ? [[$winnerId, $winnerScore]] : $winners;
    }
}
