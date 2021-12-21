<?php

namespace Day7\Puzzle1;

use Utils\FileParser;

class Solver
{
    protected array $horizontalPositions = [];

    public function __construct(string $filePath)
    {
        $inputContent = FileParser::parseInputSeparatedByComma($filePath);
        $this->horizontalPositions = array_map(fn (string $horizontalPosition) => (int) $horizontalPosition, $inputContent);
    }

    public function solve(): ?int
    {
        $leastFuelPossible = null;
        foreach($this->horizontalPositions as $horizontalPosition) {
            $consumedFuel = 0;
            foreach($this->horizontalPositions as $tempHorizontalPosition) {
                $consumedFuel += abs($horizontalPosition - $tempHorizontalPosition);
            }
            if (!$leastFuelPossible) {
                $leastFuelPossible = $consumedFuel;
            }
            if ($leastFuelPossible > $consumedFuel) {
                $leastFuelPossible = $consumedFuel;
            }
        }

        return $leastFuelPossible;
    }
}
