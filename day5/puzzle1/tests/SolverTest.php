<?php

namespace Day5\Puzzle1\Tests;

use Day5\Puzzle1\Solver;
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
            'file path' => '/day5/inputs/sampleInput.txt',
            'expected answer' => 5
        ];
        yield 'Given input should return answer' => [
            'file path' => '/day5/inputs/input.txt',
            'expected answer' => 6572
        ];
    }
}
