<?php

namespace Day1\SecondPuzzle;

use Day1\FirstPuzzle\Solver as FirstPuzzleSolver;

class Solver
{
    public static function solve(string $fileName): int
    {
        $inputContent = file_get_contents(__DIR__.'/../inputs/'.$fileName);

        $depths = explode("\n", $inputContent);

        $threeMeasurementDepthSums = [];

        $index = 0;
        while ($index < max(array_keys($depths))) {
            $threeMeasurementDepthSums[] = array_sum(array_slice($depths, $index, 3));
            $index++;
        }

        return FirstPuzzleSolver::computeDepthMeasurementIncreases($threeMeasurementDepthSums);
    }
}