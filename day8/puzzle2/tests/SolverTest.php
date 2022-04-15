<?php

namespace Day8\Puzzle2\Tests;

use Day8\Puzzle2\Solver;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
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
            'file path' => '/Day8/Inputs/sampleInput.txt',
            'expected answer' => 61229,
        ];

        yield 'Given input should return answer' => [
            'file path' => '/Day8/Inputs/input.txt',
            'expected answer' => 1070188,
        ];
    }
}
