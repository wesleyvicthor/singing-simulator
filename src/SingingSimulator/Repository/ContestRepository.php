<?php

namespace InnoGames\SingingSimulator\Repository;

use InnoGames\SingingSimulator\Contest\Winner;
use PDO;

final class ContestRepository implements ContestRepositoryInterface
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function persistWinners(string $contestId, Winner ...$winners): void
    {
        foreach ($winners as $winner) {
            $stmt = $this->db->prepare('INSERT INTO contest_winners(contest_id, contestant_id, score) values(?, ?, ?)');
            $stmt->execute([$contestId, $winner->contestant()->id(), $winner->score()]);
        }
    }

    public function fetchLastFiveWinners(): array
    {
        $stmt = $this->db->query('select * from contest_winners order by created_at desc limit 5');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchTopScoringContestant()
    {
        $stmt = $this->db->query('select * from contest_winners order by score desc limit 1');

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
