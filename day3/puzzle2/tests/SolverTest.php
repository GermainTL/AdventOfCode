<?php

namespace Day3\Puzzle2\Tests;

use Day3\Puzzle2\Solver;
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

        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function solveProvider()
    {
        yield 'Given example should return given answer' => [
            'file path' => '/Day3/Inputs/sampleInput.txt',
            'expected power consumption' => 230
        ];
        yield 'Given input should return the answer to puzzle' => [
            'file path' => '/Day3/Inputs/input.txt',
            'expected life support rating' => 5852595
        ];
    }

    /**
     * @dataProvider computeOxygenGeneratorRatingProvider
     */
    public function testComputeOxygenGeneratorRating(string $inputFilePath, int $expectedOutput)
    {
        $solver = new Solver($inputFilePath);
        $actualOutput = $solver->computeOxygenGeneratorRating();

        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function computeOxygenGeneratorRatingProvider()
    {
        yield 'Given example should return oxygen generator rating' => [
            'file path' => '/Day3/Inputs/sampleInput.txt',
            'expected oxygen generator rating' => 23
        ];
        yield 'Given input should return the correct oxygen generator rating' => [
            'file path' => '/Day3/Inputs/input.txt',
            'expected oxygen generator rating' => 2919
        ];
    }

    /**
     * @dataProvider computeCO2ScrubberRatingProvider
     */
    public function testComputeCO2ScrubberRating(string $inputFilePath, int $expectedOutput)
    {
        $solver = new Solver($inputFilePath);
        $actualOutput = $solver->computeCO2ScrubberRating();

        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function computeCO2ScrubberRatingProvider()
    {
        yield 'Given example should return given CO2 scrubber rating' => [
            'file path' => '/Day3/Inputs/sampleInput.txt',
            'expected CO2 scrubber rating' => 10
        ];
        yield 'Given input should return the correct CO2 scrubber rating' => [
            'file path' => '/Day3/Inputs/input.txt',
            'expected CO2 scrubber rating' => 2005
        ];
    }
}
