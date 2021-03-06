<?php

namespace Day10\Puzzle1\Tests;

use Day10\Puzzle1\Solver;
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
            'file path' => '/Day10/Inputs/sampleInput.txt',
            'expected answer' => 26397
        ];
        yield 'Given input should return answer' => [
            'file path' => '/Day10/Inputs/input.txt',
            'expected answer' => 318081
        ];
    }
}
