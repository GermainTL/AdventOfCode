<?php

namespace Day5\Puzzle1;

use Day5\LineDTO;
use Day5\PointDTO;
use Utils\FileParser;

class Solver
{
    protected array $lines = [];

    protected array $diagram = [];

    public function __construct(string $filePath)
    {
        $inputContent = FileParser::parseInputSeparatedByBreakLines($filePath);
        $this->setLines($inputContent);
        $this->initializeDiagram($inputContent);
    }

    public function solve(): int
    {
       foreach($this->lines as $line) {
           $this->drawLineOnDiagram($line);
       }

       return $this->getPointsGreatherThanTwo();
    }

    private function setLines(array $inputContent): void
    {
        foreach($inputContent as $inputLine) {
            $points = [];
            foreach(explode("->", $inputLine) as $key => $inputPoint) {
                $pointCoordinates = explode(",",trim($inputPoint));
                $pointDTO =  new PointDTO();
                $pointDTO->x = intval($pointCoordinates[0]);
                $pointDTO->y = intval($pointCoordinates[1]);

                $points[$key] = $pointDTO;
            }
            $lineDTO = new LineDTO();
            $lineDTO->point1 = $points[0];
            $lineDTO->point2 = $points[1];

            $this->lines[] = $lineDTO;
        }
    }

    private function initializeDiagram(array $inputContent): void
    {
        $diagramSize = 0;
        foreach ($inputContent as $inputLine) {
            foreach (explode("->", $inputLine) as $key => $inputPoint) {
                $pointCoordinates = explode(",",trim($inputPoint));
                foreach ($pointCoordinates as $pointCoordinate) {
                    if ($diagramSize < intval($pointCoordinate)) {
                        $diagramSize = intval($pointCoordinate);
                    }
                }
            }
        }

        for ($rowIndex = 0; $rowIndex <= $diagramSize; $rowIndex++) {
            if (!isset($this->diagram[$rowIndex])) {
                $this->diagram[$rowIndex] = [];
            }

            for ($columnIndex = 0; $columnIndex <= $diagramSize; $columnIndex++) {
                $this->diagram[$rowIndex][$columnIndex] = 0;
            }
        }
    }

    protected function drawLineOnDiagram(LineDTO $lineDTO): void
    {
        if ($lineDTO->point1->x === $lineDTO->point2->x) {
            $maxCoordinate = $lineDTO->point1->y > $lineDTO->point2->y ? $lineDTO->point1->y : $lineDTO->point2->y;
            $minCoordinate = $lineDTO->point1->y > $lineDTO->point2->y ? $lineDTO->point2->y :  $lineDTO->point1->y;

            for($columnIndex = $minCoordinate; $columnIndex <= $maxCoordinate; $columnIndex++) {
                $this->diagram[$lineDTO->point1->x][$columnIndex] += 1;
            }
        }
        if ($lineDTO->point1->y === $lineDTO->point2->y) {
            $maxCoordinate = $lineDTO->point1->x > $lineDTO->point2->x ? $lineDTO->point1->x : $lineDTO->point2->x;
            $minCoordinate = $lineDTO->point1->x > $lineDTO->point2->x ? $lineDTO->point2->x :  $lineDTO->point1->x;

            for($rowIndex = $minCoordinate; $rowIndex <= $maxCoordinate; $rowIndex++) {
                $this->diagram[$rowIndex][$lineDTO->point1->y] += 1;
            }
        }
    }

    protected function getPointsGreatherThanTwo(): int
    {
        $pointsGreaterThanTwo = 0;
        foreach($this->diagram as $line) {
            foreach($line as $number) {
                if ($number > 1) {
                    $pointsGreaterThanTwo++;
                }
            }
        }

        return $pointsGreaterThanTwo;
    }
}
