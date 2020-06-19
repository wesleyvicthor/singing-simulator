<?php

namespace InnoGames\Repository;

use InnoGames\SingingSimulator\Contest\Winner;
use PDO;

final class ContestRepository implements ContestRepositoryInterface
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function persistWinners(Winner ...$winners)
    {
        foreach ($winners as $winner) {
            $stmt = $this->db->prepare('INSERT INTO contest_winners(contestant_id, score) values(?, ?)');
            $stmt->execute([$winner->contestant()->id(), $winner->score()]);
        }
    }
}
