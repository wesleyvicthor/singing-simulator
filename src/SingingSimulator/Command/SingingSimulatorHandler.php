<?php

namespace InnoGames\SingingSimulator\Command;

use InnoGames\SingingSimulator\SingingSimulator;
use Symfony\Component\Console\Helper\Table;
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
            $this->displayResult($io, $round->result(), 'Round '.$round->genre());

            $io->ask("Next Round");
        }

//        $winners = $contest->winners();
//        var_dump($winners);

        $this->displayResult($io, $contest->result(), 'Contest Final Result');
    }

    private function displayResult(OutputInterface $io, array $result, string $title)
    {
        $header = ["#", "Score"];

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
        $table->setHeaders($header);
        $table->setRows($rows);
        $table->setHeaderTitle($title);
        $table->setStyle('box-double');
        $table->setColumnWidths([10, 10]);
        $table->render();
    }
}
