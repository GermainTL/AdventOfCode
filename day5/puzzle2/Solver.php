<?php

namespace Day5\Puzzle2;

use Day5\LineDTO;
use Day5\PointDTO;
use Day5\Puzzle1\Solver as Puzzle1Solver;

class Solver extends Puzzle1Solver
{
    protected array $lines = [];

    protected array $diagram = [];

    public function __construct(string $filePath)
    {
        parent::__construct($filePath);
    }

    public function solve(): int
    {
        foreach ($this->lines as $line) {
            $this->drawLineOnDiagram($line);
        }

        return $this->getPointsGreatherThanTwo();
    }

    protected function drawLineOnDiagram(LineDTO $lineDTO): void
    {
        parent::drawLineOnDiagram($lineDTO);
        if (abs($lineDTO->point1->x - $lineDTO->point2->x) === abs($lineDTO->point1->y - $lineDTO->point2->y)) {
            $maxYCoordinate = $lineDTO->point1->y > $lineDTO->point2->y ? $lineDTO->point1->y : $lineDTO->point2->y;
            $minYCoordinate = $lineDTO->point1->y > $lineDTO->point2->y ? $lineDTO->point2->y : $lineDTO->point1->y;

            $maxXCoordinate = $lineDTO->point1->x > $lineDTO->point2->x ? $lineDTO->point1->x : $lineDTO->point2->x;
            $minXCoordinate = $lineDTO->point1->x > $lineDTO->point2->x ? $lineDTO->point2->x : $lineDTO->point1->x;

            for ($rowIndex = $minXCoordinate; $rowIndex <= $maxXCoordinate; $rowIndex++) {
                for ($columnIndex = $minYCoordinate; $columnIndex <= $maxYCoordinate; $columnIndex++) {
                    if (abs($lineDTO->point1->x - $rowIndex) === abs($lineDTO->point1->y - $columnIndex)) {
                        $this->diagram[$rowIndex][$columnIndex] += 1;
                    }
                }
            }
        }
    }
}
