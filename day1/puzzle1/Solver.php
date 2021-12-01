<?php

namespace Day1\Puzzle1;

class Solver
{
    public static function solve(string $fileName): int
    {
        $inputContent = file_get_contents(__DIR__.'/../inputs/'.$fileName);

        $depths = explode("\n", $inputContent);

        return self::computeDepthMeasurementIncreases($depths);
    }

    public static function computeDepthMeasurementIncreases(array $depths): int
    {
        $depthMeasurementIncreases = 0;
        $lastDepth = null;
        foreach($depths as $depth) {
            if ($lastDepth && $depth > $lastDepth) {
                $depthMeasurementIncreases ++;
            }
            $lastDepth = $depth;
        }

        return $depthMeasurementIncreases;
    }
}