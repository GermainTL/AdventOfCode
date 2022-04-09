<?php

namespace Day11\Puzzle2\Tests;

use Day11\Puzzle2\Solver;
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
        $solver = new Solver();
        $actualOutput = $solver->solve($inputFilePath);

        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function solveProvider()
    {
        yield 'Given example should return given answer' => [
            'file path' => '/day11/inputs/sampleInput.txt',
            'expected answer' => 195,
        ];

        yield 'Given input should return answer' => [
            'file path' => '/day11/inputs/input.txt',
            'expected answer' => 312,
        ];
    }
}
