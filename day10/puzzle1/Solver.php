<?php

namespace Day10\Puzzle1;

use Utils\FileParser;

class Solver
{
    public const CHARACTERS_PAIRS = [
        '(' => ')',
        '{' => '}',
        '[' => ']',
        '<' => '>',
    ];

    public const ERROR_SCORE = [
        ')' =>  3,
        ']' => 57,
        '}' => 1197,
        '>' => 25137,
    ];

    private array $lines;

    public function __construct(string $filePath)
    {
        $inputContent = FileParser::parseInputSeparatedByBreakLines($filePath);
        $this->lines = $inputContent;
    }

    public function solve(): int
    {
        $illegalCharacters = $this->getIllegalCharacters();

        return self::computeIllegalCharactersScore($illegalCharacters);
    }

    private function getIllegalCharacters(): array
    {
        $illegalCharacters = [];

        foreach ($this->lines as $lineIndex => $line) {
            $openingCharacters = [];
            foreach (str_split($line) as $characterIndex => $character) {
                $isAClosingCharacter = !isset(self::CHARACTERS_PAIRS[$character]);
                if ($isAClosingCharacter) {
                    $expectedNextClosingChar = self::CHARACTERS_PAIRS[end($openingCharacters)];
                    if ($character !== $expectedNextClosingChar) {
                        $illegalCharacters[] = $character;

                        break;
                    } else {
                        array_pop($openingCharacters);
                    }
                } else {
                    $openingCharacters[] = $character;
                }
            }
        }

        return $illegalCharacters;
    }

    private static function computeIllegalCharactersScore(array $illegalCharacters): int
    {
        $scores = array_map(fn (string $illegalChar) => self::ERROR_SCORE[$illegalChar], $illegalCharacters);

        return array_sum($scores);
    }
}
