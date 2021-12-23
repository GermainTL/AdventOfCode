<?php

namespace Day7\Puzzle1\Tests;

use Day7\Puzzle1\Solver;
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
            'file path' => '/day7/inputs/sampleInput.txt',
            'expected answer' => 37
        ];
        yield 'Given input should return answer' => [
            'file path' => '/day7/inputs/input.txt',
            'expected answer' => 343441
        ];
    }
}
