<?php

namespace Day9\Puzzle1;

use Utils\FileParser;

class Solver
{
    private array $heightmap = [];

    public function __construct(string $filePath)
    {
        $inputContent = FileParser::parseInputSeparatedByBreakLines($filePath);
        $this->setHeightmap($inputContent);
    }

    public function solve(): int
    {
        $lowestPoints = $this->getLowestPoints();

        return $this->getSumOfRiskLevels($lowestPoints);
    }

    private function getLowestPoints(): array
    {
        $lowestPoints = [];
        foreach ($this->heightmap as $lineNumber => $heightmapLine) {
            foreach ($heightmapLine as $heightKey => $height) {
                $adjacentHeights = [
                    $heightmapLine[$heightKey - 1] ?? null,
                    $heightmapLine[$heightKey + 1] ?? null,
                    $this->heightmap[$lineNumber - 1][$heightKey] ?? null,
                    $this->heightmap[$lineNumber + 1][$heightKey] ?? null
                ];

                $isALowestPoint = true;
                foreach ($adjacentHeights as $adjacentHeight) {
                    if ($adjacentHeight !== null && $adjacentHeight <= $height) {
                        $isALowestPoint = false;
                    }
                }

                if ($isALowestPoint) {
                    $lowestPoints[] = $height;
                }
            }
        }

        return $lowestPoints;
    }

    private function getSumOfRiskLevels(array $lowestPoints): int
    {
        $riskLevels = array_map(fn ($lowestPoint) => $lowestPoint + 1, $lowestPoints);

        return array_sum($riskLevels);
    }

    private function setHeightmap(array $lines): self
    {
        $heightmap = [];
        foreach ($lines as $line) {
            $heightmap[] = array_map(fn (string $height) => (int) $height, str_split($line));
        }

        $this->heightmap = $heightmap;

        return $this;
    }
}
