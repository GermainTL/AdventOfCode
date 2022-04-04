<?php

namespace Day10\Puzzle2;

use Utils\FileParser;

class Solver
{
    public const CHARACTERS_PAIRS = [
        '(' => ')',
        '{' => '}',
        '[' => ']',
        '<' => '>',
    ];

    public const COMPLETION_SCORE = [
        ')' =>  1,
        ']' => 2,
        '}' => 3,
        '>' => 4,
    ];

    private array $lines;

    public function __construct(string $filePath)
    {
        $inputContent = FileParser::parseInputSeparatedByBreakLines($filePath);
        $this->lines = $inputContent;
    }

    public function solve(): int
    {
        $this->discardCorruptedLines();

        $completionChars = $this->getCompletionChars();

        $completionCharacterScores = self::computeCompletionCharacterScores($completionChars);

        return self::getMiddleCompletionCharacterScore($completionCharacterScores);
    }

    private function discardCorruptedLines(): void
    {
        foreach ($this->lines as $lineIndex => $line) {
            $openingCharacters = new \SplStack();
            foreach (str_split($line) as $characterIndex => $character) {
                $isAClosingCharacter = !isset(self::CHARACTERS_PAIRS[$character]);
                if ($isAClosingCharacter) {
                    $openingCharacters->rewind();
                    $expectedNextClosingChar = self::CHARACTERS_PAIRS[$openingCharacters->current()];
                    if ($character !== $expectedNextClosingChar) {
                        $arrayToRemoveIndex = array_search($line, $this->lines);
                        array_splice($this->lines, $arrayToRemoveIndex, 1);

                        break;
                    } else {
                        $openingCharacters->pop();
                    }
                } else {
                    $openingCharacters[] = $character;
                }
            }
        }
    }

    private function getCompletionChars(): array
    {
        $completionChars = [];

        foreach ($this->lines as $lineIndex => $line) {
            $completionChars[$lineIndex] = [];
            $remainingOpeningChars = self::getRemainingOpeningChars($line);

            $remainingOpeningChars->rewind();
            while ($remainingOpeningChars->valid()) {
                $completionChars[$lineIndex][] = self::CHARACTERS_PAIRS[$remainingOpeningChars->current()];
                $remainingOpeningChars->next();
            }
        }

        return $completionChars;
    }

    private static function getRemainingOpeningChars(string $line): \SplStack
    {
        $openingCharacters = new \SplStack();
        foreach (str_split($line) as $characterIndex => $character) {
            $isAClosingCharacter = !isset(self::CHARACTERS_PAIRS[$character]);
            if ($isAClosingCharacter) {
                $openingCharacters->pop();
            } else {
                $openingCharacters[] = $character;
            }
        }

        return $openingCharacters;
    }

    private static function computeCompletionCharacterScores(array $completionChars): array
    {
        $completionCharacterScores = [];

        foreach ($completionChars as $lineIndex => $completionCharLine) {
            $completionCharacterScores[$lineIndex] = 0;
            foreach ($completionCharLine as $completionChar) {
                $completionCharacterScores[$lineIndex] *= 5;
                $completionCharacterScores[$lineIndex] += self::COMPLETION_SCORE[$completionChar];
            }
        }

        return $completionCharacterScores;
    }

    private static function getMiddleCompletionCharacterScore(array $completionCharacterScores): int
    {
        sort($completionCharacterScores);
        $middleScoreIndex = (count($completionCharacterScores) - 1) / 2;

        return $completionCharacterScores[$middleScoreIndex];
    }
}
