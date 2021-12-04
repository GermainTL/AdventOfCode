<?php

namespace Day3\Puzzle1\Tests;

use Day2\Puzzle1\Solver;
use PHPUnit\Framework\TestCase;

class SolverTest extends TestCase
{
    /**
     * @dataProvider solveProvider
     */
    public function testSolve(string $inputFileName, int $expectedOutput)
    {
        $solution = new Solver();
        $actualOutput = $solution->solve($inputFileName);

        $this->assertEquals($expectedOutput,$actualOutput);
    }

    public function solveProvider()
    {
        yield 'Given example should return given answer' => [
            'file name' => '/day3/inputs/sampleInput.txt',
            'expected power consumption' => 198
        ];
        yield 'Given input should return the answer to puzzle' => [
            'file name' => '/day3/inputs/input.txt',
            'expected power consumption' => 1602
        ];
    }

    /**
     * @dataProvider computeGammaRateProvider
     */
    public function testComputeGammaRate(string $inputFileName, int $expectedOutput)
    {
        $solution = new Solver();
        $actualOutput = $solution->computeGammaRate($inputFileName);

        $this->assertEquals($expectedOutput,$actualOutput);
    }

    public function computeGammaRateProvider()
    {
        yield 'Given example should return epsilon rate' => [
            'file name' => '/day3/inputs/sampleInput.txt',
            'expected gamma rate' => 22
        ];
        yield 'Given input should return the correct gamma rate' => [
            'file name' => '/day3/inputs/input.txt',
            'expected gamma rate' => 1602
        ];
    }

    /**
     * @dataProvider computeEpsilonRateProvider
     */
    public function testComputeEpsilonRate(string $inputFileName, int $expectedOutput)
    {
        $solution = new Solver();
        $actualOutput = $solution->computeEpsilonRate($inputFileName);

        $this->assertEquals($expectedOutput,$actualOutput);
    }

    public function computeEpsilonRateProvider()
    {
        yield 'Given example should return given epsilon rate' => [
            'file name' => '/day3/inputs/sampleInput.txt',
            'expected Epsilon rate' => 9
        ];
        yield 'Given input should return the correct epsilon rate' => [
            'file name' => '/day3/inputs/input.txt',
            'expected Epsilon rate' => 1602
        ];
    }
}