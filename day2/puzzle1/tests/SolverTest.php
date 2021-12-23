<?php

namespace Day2\Puzzle1\Tests;

use Day2\Puzzle1\Solver;
use PHPUnit\Framework\TestCase;

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
            'file path' => '/day2/inputs/sampleInput.txt',
            'expected output' => 150
        ];
        yield 'Given input should return the answer to puzzle' => [
            'file path' => '/day2/inputs/input.txt',
            'expected output' => 1602
        ];
    }
}
