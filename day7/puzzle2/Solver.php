<?php

namespace Day7\Puzzle2;

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
        for($potentialPosition = 0; $potentialPosition <= max($this->horizontalPositions); $potentialPosition++) {
            $consumedFuel = 0;
            foreach($this->horizontalPositions as $horizontalPosition) {
                if (abs($horizontalPosition - $potentialPosition) !== 0) {
                    $consumedFuel += array_sum(range(1, abs($horizontalPosition - $potentialPosition)));
                }
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
