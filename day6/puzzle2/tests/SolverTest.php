<?php

namespace Day6\Puzzle2\Tests;

use Day6\Puzzle2\Solver;
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
        $actualOutput = $solver->solve(256);

        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function solveProvider()
    {
        yield 'Given example should return given answer' => [
            'file path' => '/Day6/Inputs/sampleInput.txt',
            'expected answer' => 26984457539,
        ];

        yield 'Given input should return answer' => [
            'file path' => '/Day6/Inputs/input.txt',
            'expected answer' => 1674303997472,
        ];
    }
}
