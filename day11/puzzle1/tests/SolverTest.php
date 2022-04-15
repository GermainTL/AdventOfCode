<?php

namespace Day11\Puzzle1\Tests;

use Day11\Puzzle1\Solver;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class SolverTest extends TestCase
{
    public const SAMPLE_INPUT_FILE_PATH = '/Day11/Inputs/sampleInput.txt';

    public const INPUT_FILE_PATH = '/Day11/Inputs/input.txt';

    /**
     * @dataProvider solveProvider
     */
    public function testSolve(string $inputFilePath, int $expectedOutput)
    {
        $solver = new Solver();
        $actualOutput = $solver->solve($inputFilePath);

        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function testShouldParseInto2dArray()
    {
        $solver = new Solver();
        $grid = $solver->parseInput(self::SAMPLE_INPUT_FILE_PATH);

        $this->assertEquals([5, 4, 8, 3, 1, 4, 3, 2, 2, 3], $grid[0]);
    }

    public function testShouldBeEqualToPuzzleDescriptionAfterStep1()
    {
        $solver = new Solver();

        $grid = $solver->parseInput(self::SAMPLE_INPUT_FILE_PATH);
        $gridAfter1Step = $solver->progress($grid);
        $normalizedGridAfter1Step = array_map(fn (array $line): string => implode('', $line), $gridAfter1Step);
        $normalizedGridAfter1Step = implode("\n", $normalizedGridAfter1Step);
        $expectedOutput = <<<'EOD'
        6594254334
        3856965822
        6375667284
        7252447257
        7468496589
        5278635756
        3287952832
        7993992245
        5957959665
        6394862637
        EOD;
        $this->assertEquals(
            $expectedOutput,
            $normalizedGridAfter1Step
        );
    }

    public function testShouldBeEqualToPuzzleDescriptionAfterStep2()
    {
        $solver = new Solver(self::SAMPLE_INPUT_FILE_PATH);

        $grid = $solver->parseInput(self::SAMPLE_INPUT_FILE_PATH);
        $gridAfter1Step = $solver->progress($grid);
        $gridAfter2Step = $solver->progress($gridAfter1Step);
        $normalizedGridAfter2Step = array_map(fn (array $line): string => implode('', $line), $gridAfter2Step);
        $normalizedGridAfter2Step = implode("\n", $normalizedGridAfter2Step);
        $expectedOutput = <<<'EOD'
        8807476555
        5089087054
        8597889608
        8485769600
        8700908800
        6600088989
        6800005943
        0000007456
        9000000876
        8700006848
        EOD;
        $this->assertEquals(
            $expectedOutput,
            $normalizedGridAfter2Step
        );
    }

    public function solveProvider()
    {
        yield 'Given example should return given answer' => [
            'file path' => self::SAMPLE_INPUT_FILE_PATH,
            'expected answer' => 1656,
        ];

        yield 'Given input should return answer' => [
            'file path' => self::INPUT_FILE_PATH,
            'expected answer' => 1640,
        ];
    }
}
