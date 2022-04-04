<?php

namespace Day11\Puzzle1;

use Utils\FileParser;

class Solver
{
    public function solve(string $inputFile): int
    {
        $grid = $this->parseInput($inputFile);

        $flashesCount = 0;
        for ($step = 0; $step < 100; ++$step) {
            $grid = $this->progress($grid);
            $flashesCount += $this->countFlashes($grid);
        }

        return $flashesCount;
    }

    public function parseInput(string $inputFilePath)
    {
        $parsedInput = FileParser::parseInputSeparatedByBreakLines($inputFilePath);

        $grid = [];
        foreach ($parsedInput as $line) {
            $grid[] = array_map(fn (string $energyLevel): int => (int) $energyLevel, str_split($line));
        }

        return $grid;
    }

    public function progress(array $grid): array
    {
        $newGrid = $grid;
        foreach ($grid as $lineIndex => $line) {
            foreach ($line as $energyLevelIndex => $energyLevel) {
                $newEnergyLevel = $energyLevel + 1;
                $newGrid[$lineIndex][$energyLevelIndex] = $newEnergyLevel;
            }
        }

        foreach ($grid as $lineIndex => $line) {
            foreach ($line as $energyLevelIndex => $energyLevel) {
                if ($newGrid[$lineIndex][$energyLevelIndex] > 9) {
                    $newGrid[$lineIndex][$energyLevelIndex] = 0;

                    $newGrid = $this->increaseAllAdjacentEnergyLevels($newGrid, $lineIndex, $energyLevelIndex);
                }
            }
        }

        return $newGrid;
    }

    public function increaseAllAdjacentEnergyLevels(array $grid, int $lineIndex, int $energyLevelIndex): array
    {
        $newGrid = $grid;
        $adjacentLineIndexes = [$lineIndex - 1, $lineIndex, $lineIndex + 1];
        $adjacentEnergyLevelIndexes = [$energyLevelIndex - 1, $energyLevelIndex, $energyLevelIndex + 1];
        foreach ($adjacentLineIndexes as $adjacentLineIndex) {
            foreach ($adjacentEnergyLevelIndexes as $adjacentEnergyLevelIndex) {
                if ($energyLevelIndex === $adjacentEnergyLevelIndex && $adjacentLineIndex === $lineIndex) {
                    continue;
                }

                if (isset($newGrid[$adjacentLineIndex][$adjacentEnergyLevelIndex]) && 0 !== $newGrid[$adjacentLineIndex][$adjacentEnergyLevelIndex]) {
                    $newEnergyLevel = $newGrid[$adjacentLineIndex][$adjacentEnergyLevelIndex] + 1;

                    if ($newEnergyLevel <= 9) {
                        $newGrid[$adjacentLineIndex][$adjacentEnergyLevelIndex] = $newEnergyLevel;
                    } else {
                        $newGrid[$adjacentLineIndex][$adjacentEnergyLevelIndex] = 0;
                        $newGrid = $this->increaseAllAdjacentEnergyLevels($newGrid, $adjacentLineIndex, $adjacentEnergyLevelIndex);
                    }
                }
            }
        }

        return $newGrid;
    }

    private function countFlashes(array $grid): int
    {
        $flashesCount = 0;
        foreach ($grid as $line) {
            foreach ($line as $energyLevel) {
                if (0 === $energyLevel) {
                    ++$flashesCount;
                }
            }
        }

        return $flashesCount;
    }
}
