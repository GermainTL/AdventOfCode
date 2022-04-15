<?php

namespace Day7\Puzzle2\Tests;

use Day7\Puzzle2\Solver;
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
            'file path' => '/Day7/Inputs/sampleInput.txt',
            'expected answer' => 168
        ];
        yield 'Given input should return answer' => [
            'file path' => '/Day7/Inputs/input.txt',
            'expected answer' => 98925151
        ];
    }
}
