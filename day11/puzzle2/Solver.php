<?php

namespace Day11\Puzzle2;

use Day11\Puzzle1\Solver as SolverPuzzle1;

class Solver extends SolverPuzzle1
{
    public function solve(string $inputFile): int
    {
        $grid = $this->parseInput($inputFile);

        $isSynchronisationDone = false;
        $step = 0;
        while (true !== $isSynchronisationDone) {
            $grid = $this->progress($grid);
            $isSynchronisationDone = $this->isSynchronisationDone($grid);
            ++$step;
        }

        return $step;
    }

    private function isSynchronisationDone(array $grid): bool
    {
        foreach ($grid as $line) {
            foreach ($line as $energyLevel) {
                if (0 !== $energyLevel) {
                    return false;
                }
            }
        }

        return true;
    }
}
