<?php

namespace Day25\Puzzle1\Tests;

use Day25\Puzzle1\Solver;
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
            'file path' => '/day25/inputs/sampleInput.txt',
            'expected answer' => 58
        ];
        yield 'Given input should return answer' => [
            'file path' => '/day25/inputs/input.txt',
            'expected answer' => 321
        ];
    }
}
