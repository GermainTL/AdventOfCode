<?php

namespace Day10\Puzzle2;

use Utils\FileParser;

class Solver
{
    private array $heightmap = [];

    private array $locationsInABasin = [];

    public function __construct(string $filePath)
    {
        $inputContent = FileParser::parseInputSeparatedByBreakLines($filePath);
        $this->setHeightmap($inputContent);
        $this->setLocationsInABasin($inputContent);
    }

    public function solve(): int
    {
        $basinSizes = $this->getBasinSizes();

        return $this->getProductOfThreeBiggerBasins($basinSizes);
    }

    private function getBasinSizes(): array
    {
        $basinSizes = [];
        foreach ($this->heightmap as $lineIndex => $heightmapLine) {
            foreach ($heightmapLine as $locationIndex => $height) {
                $adjacentLocations = $this->getAdjacentLocations($lineIndex, $locationIndex);

                $isALowestPoint = true;
                foreach ($adjacentLocations as $adjacentLocation) {
                    if ($adjacentLocation['height'] !== null && $adjacentLocation['height'] <= $height) {
                        $isALowestPoint = false;
                    }
                }

                if ($isALowestPoint) {
                    $this->locationsInABasin[$lineIndex][$locationIndex] = true;
                    $basinSizes[] = $this->getBasinSize($lineIndex, $locationIndex, 1);
                }
            }
        }

        return $basinSizes;
    }

    private function getBasinSize($lineIndex, $locationIndex, $initialBasinSize): int
    {
        $basinSize = $initialBasinSize;
        $adjacentLocations = $this->getAdjacentLocations($lineIndex, $locationIndex);

        foreach ($adjacentLocations as $adjacentLocation) {
            if ($adjacentLocation['height'] !== null &&
                $adjacentLocation['height'] !== 9 &&
                !$this->locationsInABasin[$adjacentLocation['lineIndex']][$adjacentLocation['heightIndex']] &&
                $adjacentLocation['height'] - $this->heightmap[$lineIndex][$locationIndex] > 0
            ) {
                $basinSize++;
                $this->locationsInABasin[$adjacentLocation['lineIndex']][$adjacentLocation['heightIndex']] = true;

                $basinSize = $this->getBasinSize($adjacentLocation['lineIndex'], $adjacentLocation['heightIndex'], $basinSize);
            }
        }

        return $basinSize;
    }

    private function getProductOfThreeBiggerBasins(array $basinSizes): int
    {
        rsort($basinSizes);
        $threeBiggerBasinSizes = array_slice($basinSizes, 0, 3);

        return array_product($threeBiggerBasinSizes);
    }

    private function getAdjacentLocations(int $lineIndex, int $locationIndex)
    {
        return  [
            [
                'lineIndex' => $lineIndex,
                'heightIndex' => $locationIndex - 1,
                'height' => $this->heightmap[$lineIndex][$locationIndex - 1] ?? null
            ],
            [
                'lineIndex' => $lineIndex,
                'heightIndex' => $locationIndex + 1,
                'height' => $this->heightmap[$lineIndex][$locationIndex + 1] ?? null
            ],
            [
                'lineIndex' => $lineIndex - 1,
                'heightIndex' => $locationIndex,
                'height' => $this->heightmap[$lineIndex - 1][$locationIndex] ?? null
            ],
            [
                'lineIndex' => $lineIndex + 1,
                'heightIndex' => $locationIndex,
                'height' => $this->heightmap[$lineIndex + 1][$locationIndex] ?? null
            ],
        ];
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

    private function setLocationsInABasin(array $lines): self
    {
        $locationsInABasin = [];
        foreach ($lines as $lineIndex => $line) {
            $locationsInABasin[] = [];
            foreach (str_split($line) as $locationIndex => $location) {
                $locationsInABasin[$lineIndex][$locationIndex] = false;
            }
        }

        $this->locationsInABasin = $locationsInABasin;

        return $this;
    }
}
