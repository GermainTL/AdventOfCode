<?php

namespace Day4\Puzzle1\Tests;

use Day4\Puzzle1\Solver;
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
            'file path' => '/Day4/Inputs/sampleInput.txt',
            'expected answer' => 4512
        ];
        yield 'Given input should return answer' => [
            'file path' => '/Day4/Inputs/input.txt',
            'expected answer' => 22680
        ];
    }
}
