<?php

namespace Day8\Puzzle1;

use Utils\FileParser;

class Solver
{
    protected array $fourDigitOutputValues = [];

    public const UNIQUE_NUMBER_OF_SEGMENTS = [2, 3, 4, 7];

    public function __construct(string $filePath)
    {
        $inputContent = FileParser::parseInputSeparatedByBreakLines($filePath);
        $this->setFourDigitOutputValues($inputContent);
    }

    public function solve(): ?int
    {
        $easyDigitsCount = 0;
        foreach ($this->fourDigitOutputValues as $fourDigitOutputValue) {
            foreach (explode(" ", $fourDigitOutputValue) as $segment) {
                if (in_array(strlen($segment), self::UNIQUE_NUMBER_OF_SEGMENTS)) {
                    $easyDigitsCount++;
                }
            }
        }

        return $easyDigitsCount;
    }

    private function setFourDigitOutputValues(array $inputContent): void
    {
        $fourDigitOutputValues = [];
        foreach ($inputContent as $entry) {
            $rawFourDigitOutputValue = explode("|", $entry)[1];
            $fourDigitOutputValues[] = trim($rawFourDigitOutputValue);
        }

        $this->fourDigitOutputValues = $fourDigitOutputValues;
    }
}
