<?php

namespace Day2\Puzzle1\Tests;

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
            'file name' => '/day2/inputs/sampleInput.txt',
            'expected output' => 150
        ];
        yield 'Given input should return the answer to puzzle' => [
            'file name' => '/day2/inputs/input.txt',
            'expected output' => 1602
        ];
    }
}