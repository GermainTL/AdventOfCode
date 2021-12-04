<?php

namespace Day3\Puzzle1\Tests;

use Day3\Puzzle1\Solver;
use PHPUnit\Framework\TestCase;

class SolverTest extends TestCase
{
    /**
     * @dataProvider solveProvider
     */
    public function testSolve(string $inputFilePath, int $expectedOutput)
    {
        $solver = new Solver($inputFilePath);
        $actualOutput = $solver->solve();

        $this->assertEquals($expectedOutput,$actualOutput);
    }

    public function solveProvider()
    {
        yield 'Given example should return given answer' => [
            'file path' => '/day3/inputs/sampleInput.txt',
            'expected power consumption' => 198
        ];
        yield 'Given input should return the answer to puzzle' => [
            'file path' => '/day3/inputs/input.txt',
            'expected power consumption' => 3923414
        ];
    }

    /**
     * @dataProvider computeGammaRateProvider
     */
    public function testComputeGammaRate(string $inputFilePath, int $expectedOutput)
    {
        $solver = new Solver($inputFilePath);
        $actualOutput = $solver->computeGammaRate();

        $this->assertEquals($expectedOutput,$actualOutput);
    }

    public function computeGammaRateProvider()
    {
        yield 'Given example should return epsilon rate' => [
            'file path' => '/day3/inputs/sampleInput.txt',
            'expected gamma rate' => 22
        ];
        yield 'Given input should return the correct gamma rate' => [
            'file path' => '/day3/inputs/input.txt',
            'expected gamma rate' => 2566
        ];
    }

    /**
     * @dataProvider computeEpsilonRateProvider
     */
    public function testComputeEpsilonRate(string $inputFilePath, int $expectedOutput)
    {
        $solver = new Solver($inputFilePath);
        $actualOutput = $solver->computeEpsilonRate();

        $this->assertEquals($expectedOutput,$actualOutput);
    }

    public function computeEpsilonRateProvider()
    {
        yield 'Given example should return given epsilon rate' => [
            'file path' => '/day3/inputs/sampleInput.txt',
            'expected Epsilon rate' => 9
        ];
        yield 'Given input should return the correct epsilon rate' => [
            'file path' => '/day3/inputs/input.txt',
            'expected Epsilon rate' => 1529
        ];
    }
}