<?php

namespace Day2\Puzzle1\Tests;

use Day2\Puzzle1\Solver;
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
            'file path' => '/Day2/Inputs/sampleInput.txt',
            'expected output' => 150,
        ];

        yield 'Given input should return the answer to puzzle' => [
            'file path' => '/Day2/Inputs/input.txt',
            'expected output' => 1728414,
        ];
    }
}
