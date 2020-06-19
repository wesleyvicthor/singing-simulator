<?php

namespace InnoGames\SingingSimulator\Command;

use InnoGames\SingingSimulator\SingingSimulator;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SingingSimulatorHandler
{
    public function __invoke(InputInterface $input, OutputInterface $output)
    {
        $singingSimulator = new SingingSimulator();
        $contest = $singingSimulator->start();

        $io = new SymfonyStyle($input, $output);
        $io->ask("Press Enter");
        foreach ($contest->progress() as $round) {
            $table = $this->createOutput($io, $round->result(), 'Round '.$round->genre());
            $table->render();

            $io->ask("Next Round");
        }

        $winners = $contest->winners();
        var_dump($winners);

        $table = $this->createOutput($io, $contest->result(), 'Contest Final Result');
        $judges = implode(', ', array_map(fn($item) => (string) $item, $singingSimulator->judges()));
        $table->addRow(new TableSeparator());
        $table->addRow([new TableCell($judges, ['colspan' => 2])]);
        $table->setFooterTitle('Contest Judges');
        $table->render();
    }

    private function createOutput(OutputInterface $io, array $result, string $title): Table
    {
        $rows = array_map(fn($item) => [$item->contestant()->id(), $item->score()], $result);
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
        $table->setHeaders(["#", "Score"]);
        $table->setRows($rows);
        $table->setHeaderTitle($title);
        $table->setStyle('box-double');
        $table->setColumnWidths([10, 10]);

        return $table;
    }
}
