<?php

namespace Day1\Puzzle2\Tests;

use Day1\Puzzle2\Solver;
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

        $this->assertEquals($expectedOutput,$actualOutput);
    }

    public function solveProvider()
    {
        yield 'Given example should return given answer' => [
            'file path' => '/day1/inputs/sampleInput.txt',
            'expected output' => 5
        ];
        yield 'Given input should return the answer to puzzle' => [
            'file path' => '/day1/inputs/input.txt',
            'expected output' => 1728414
        ];
    }
}