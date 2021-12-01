<?php

namespace Day1\FirstPuzzle;

class Solver
{
    public static function solve(string $fileName): int
    {
        $inputContent = file_get_contents(__DIR__.'/../inputs/'.$fileName);

        $depths = explode("\n", $inputContent);

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