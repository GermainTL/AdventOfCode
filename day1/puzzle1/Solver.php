<?php

namespace Day1\Puzzle1;

use Utils\FileParser;

class Solver
{
    public static function solve(string $filePath): int
    {
        $depths = FileParser::parseInputSeparatedByBreakLines($filePath);

        return self::computeDepthMeasurementIncreases($depths);
    }

    public static function computeDepthMeasurementIncreases(array $depths): int
    {
        $depthMeasurementIncreases = 0;
        $lastDepth = null;
        foreach ($depths as $depth) {
            if ($lastDepth && $depth > $lastDepth) {
                $depthMeasurementIncreases ++;
            }
            $lastDepth = $depth;
        }

        return $depthMeasurementIncreases;
    }
}
