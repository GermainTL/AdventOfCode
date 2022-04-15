<?php

namespace Day9\Puzzle1\Tests;

use Day9\Puzzle1\Solver;
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
            'file path' => '/Day9/Inputs/sampleInput.txt',
            'expected answer' => 15
        ];
        yield 'Given input should return answer' => [
            'file path' => '/Day9/Inputs/input.txt',
            'expected answer' => 534
        ];
    }
}
