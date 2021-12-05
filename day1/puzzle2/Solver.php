<?php

namespace Day1\Puzzle2;

use Day1\Puzzle1\Solver as Puzzle1Solver;
use Utils\FileParser;

class Solver
{
    public static function solve(string $filePath): int
    {
        $depths = FileParser::parseInputSeparatedByBreakLines($filePath);

        $threeMeasurementDepthSums = [];

        $index = 0;
        while ($index < max(array_keys($depths))) {
            $threeMeasurementDepthSums[] = array_sum(array_slice($depths, $index, 3));
            $index++;
        }

        return Puzzle1Solver::computeDepthMeasurementIncreases($threeMeasurementDepthSums);
    }
}