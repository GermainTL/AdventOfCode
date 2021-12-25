<?php

namespace Day25\Puzzle1;

use Utils\FileParser;

class Solver
{
    private array $lines;

    public function __construct(string $filePath)
    {
        $inputContent = FileParser::parseInputSeparatedByBreakLines($filePath);
        $this->lines = self::parseLines($inputContent);
    }

    public function solve(): int
    {
        $seaCucumberCount = $this->getSeaCucumberCount();

        $step = 0;
        $blockedSeaCucumberCount = 0;
        while ($blockedSeaCucumberCount < $seaCucumberCount) {
            $blockedSeaCucumberCount = 0;

            $newLinesAfterEastMove = $this->lines;
            foreach ($this->lines as $lineIndex => $line) {
                foreach ($line as $seaCucumberIndex => $seaCucumber) {
                    if ($seaCucumber === '>') {
                        $isAtEndOfLine = $seaCucumberIndex + 1 === count($line);
                        $newSeaCucumberIndex = $isAtEndOfLine ? 0 : $seaCucumberIndex + 1;
                        if ($line[$newSeaCucumberIndex] === '.') {
                            $newLinesAfterEastMove[$lineIndex][$seaCucumberIndex] = '.';
                            $newLinesAfterEastMove[$lineIndex][$newSeaCucumberIndex] = '>';
                        } else {
                            $blockedSeaCucumberCount++;
                        }
                    }
                }
            }

            $this->lines = $newLinesAfterEastMove;

            $newLinesAfterSouthMove = $this->lines;
            foreach ($this->lines as $lineIndex => $line) {
                foreach ($line as $seaCucumberIndex => $seaCucumber) {
                    if ($seaCucumber === 'v') {
                        $isAtEndOfLine = $lineIndex + 1 === count($this->lines);
                        $newLineIndex = $isAtEndOfLine ? 0 : $lineIndex + 1;
                        if ($this->lines[$newLineIndex][$seaCucumberIndex] === '.') {
                            $newLinesAfterSouthMove[$lineIndex][$seaCucumberIndex] = '.';
                            $newLinesAfterSouthMove[$newLineIndex][$seaCucumberIndex] = 'v';
                        } else {
                            $blockedSeaCucumberCount++;
                        }
                    }
                }
            }
            $this->lines = $newLinesAfterSouthMove;

            $step++;
        }

        return $step;
    }

    private function getSeaCucumberCount()
    {
        $seaCucumberCount = 0;

        foreach ($this->lines as $line) {
            foreach ($line as $seaCucumberLocation) {
                if ($seaCucumberLocation === 'v' || $seaCucumberLocation === '>') {
                    $seaCucumberCount++;
                }
            }
        }

        return $seaCucumberCount;
    }

    private static function parseLines(array $inputContent): array
    {
        $lines = [];
        foreach ($inputContent as $lineAsString) {
            $line = str_split($lineAsString);
            $lines[] = $line;
        }

        return $lines;
    }
}
