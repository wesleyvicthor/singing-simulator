<?php

namespace InnoGames\SingingSimulator\Command;

use InnoGames\SingingSimulator\Repository\ContestRepository;
use InnoGames\SingingSimulator\SingingSimulator;
use PDO;
use PDOException;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SingingSimulatorHandler
{
    const OPT_HISTORY = 'history';

    private ContestRepository $repository;

    public function __construct()
    {
        $dbHost = getenv('DB_HOST');
        $pdo = new PDO("mysql:dbname=inno;host={$dbHost}", getenv('DB_USER'), getenv('DB_PASSW'));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->repository = new ContestRepository($pdo);;
    }

    public function __invoke(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption(self::OPT_HISTORY)) {
            $this->showHistory($input, $output);

            return 0;
        }

        $singingSimulator = new SingingSimulator();
        $contest = $singingSimulator->start();

        $io = new SymfonyStyle($input, $output);
        $io->ask("Press Enter");
        foreach ($contest->progress() as $round) {
            $table = $this->createOutput($io, $round->result(), 'Round '.$round->genre());
            $table->render();

            $io->ask("Next Round");
        }

        $table = $this->createOutput($io, $contest->result(), 'Contest Final Result');
        $judges = implode(', ', array_map(fn($item) => (string) $item, $singingSimulator->judges()));
        $table->addRow(new TableSeparator());
        $table->addRow([new TableCell($judges, ['colspan' => 3])]);
        $table->setFooterTitle('Contest Judges');
        $table->render();

        try {
            $this->repository->persistWinners($contest->id(), ...$contest->winners());
        } catch(PDOException $e) {
            $io->error($e->getMessage());

            return 1;
        }

        return 0;
    }

    private function createOutput(OutputInterface $io, array $result, string $title): Table
    {
        $rows = array_map(fn($item) => [$item->contestant()->id(), $item->score(), $item->contestant()->isSick() ? 'Y' : 'N'], $result);
        usort($rows, function ($a, $b) {
            if ($a[1] > $b[1]) {
                return -1;
            }

            if ($a[1] < $b[1]) {
                return 1;
            }

            return 0;
        });

        $table = new Table($io);
        $table->setHeaders(['#', 'Score', 'Sick']);
        $table->setRows($rows);
        $table->setHeaderTitle($title);
        $table->setStyle('box-double');
        $table->setColumnWidths([10, 10]);

        return $table;
    }

    private function showHistory(InputInterface $input, OutputInterface $output)
    {
        $lastWinners = (array) $this->repository->fetchLastFiveWinners();

        $topWinner = $this->repository->fetchTopScoringContestant();

        $table = new Table($io = new SymfonyStyle($input, $output));
        $table->setHeaders(['Contest ID', 'Contestant ID', 'Score', 'Date']);
        $table->setRows($lastWinners);
        $table->setHeaderTitle('Last Five Winners');
        $table->setColumnWidths([10, 10]);
        $table->render();

        $io->title('Top Scoring All Time');
        $io->section(sprintf('Contestant %s score %s', $topWinner['contestant_id'], $topWinner['score']));
    }
}
