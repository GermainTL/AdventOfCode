<?php

namespace Day8\Puzzle2;

use Utils\FileParser;

class Solver
{
    protected array $entries = [];

    const UNIQUE_NUMBER_OF_SEGMENTS = [
        ['numberOfSegment' => 2, 'digitValue' => 1],
        ['numberOfSegment' => 3, 'digitValue' => 7],
        ['numberOfSegment' => 4, 'digitValue' => 4],
        ['numberOfSegment' => 7, 'digitValue' => 8]
    ];

    public function __construct(string $filePath)
    {
        $inputContent = FileParser::parseInputSeparatedByBreakLines($filePath);
        $this->setEntries($inputContent);
    }

    public function solve(): ?int
    {
        $total = 0;
        foreach($this->entries as $entry) {
            $explodedEntry = explode("|", $entry);
            $signalPatternsByDigitValue = $this->computeSignalPatternsByDigitValue(explode(" ", trim($explodedEntry[0])));
            $total += $this->getFourDigitOutput(explode(" ", trim($explodedEntry[1])), $signalPatternsByDigitValue);
        }

        return $total;
    }

    public function computeSignalPatternsByDigitValue(array $tenDigitsSignal)
    {
        $easySignalPatternsByDigitValue = $this->getEasyDigits($tenDigitsSignal);
        return $this->deduceOtherDigits($easySignalPatternsByDigitValue, $tenDigitsSignal);
    }

    public function getEasyDigits(array $tenDigitsSignal): array
    {
        $easyDigits = [];
        foreach($tenDigitsSignal as $segment) {
            $uniqueNumberOfSegmentKey = array_search(strlen($segment), array_column(self::UNIQUE_NUMBER_OF_SEGMENTS, 'numberOfSegment'));
            if ($uniqueNumberOfSegmentKey !== false) {
                $easyDigits[self::UNIQUE_NUMBER_OF_SEGMENTS[$uniqueNumberOfSegmentKey]['digitValue']] = $segment;
            }
        }

        return $easyDigits;
    }

    public function deduceOtherDigits(array $easyDigits, array $tenDigitsSignal): array
    {
        $signalPatternsByDigitValue = $easyDigits;

        foreach($tenDigitsSignal as $signal) {
            if (strlen($signal) === 6) {
                if(!self::isStringContainingAllCharsOfString($signal, $signalPatternsByDigitValue[1])) {
                    $signalPatternsByDigitValue[6] = $signal;
                } else if (!self::isStringContainingAllCharsOfString($signal, $signalPatternsByDigitValue[4])) {
                    $signalPatternsByDigitValue[0] = $signal;
                } else {
                    $signalPatternsByDigitValue[9] = $signal;
                }
            }
        }

        foreach($tenDigitsSignal as $signal) {
            if (strlen($signal) === 5) {
                if (!self::isStringContainingAllCharsOfString($signalPatternsByDigitValue[9], $signal)) {
                    $signalPatternsByDigitValue[2] = $signal;
                } else if (!self::isStringContainingAllCharsOfString($signal, $signalPatternsByDigitValue[7])) {
                    $signalPatternsByDigitValue[5] = $signal;
                } else {
                    $signalPatternsByDigitValue[3] = $signal;
                }
            }
        }

        return $signalPatternsByDigitValue;
    }

    private function getFourDigitOutput(array $digitOutputAsSignal, array $signalPatternsByDigitValue): int
    {
        $fourDigitOuput = '';
        foreach($digitOutputAsSignal as $signal) {
            foreach($signalPatternsByDigitValue as $digitValue => $signalPattern) {
                if (self::isAnagram($signalPattern, $signal)) {
                    $fourDigitOuput .= (string) $digitValue;
                }
            }
        }

        return intval($fourDigitOuput);
    }

    private function setEntries(array $entries): void
    {
        $this->entries = $entries;
    }

    private static function isStringContainingAllCharsOfString(string $haystack, string $needle): bool
    {
        foreach(str_split($needle) as $needleChar) {
            if (strpos($haystack, $needleChar) === false) {
                return false;
            }
        }

        return true;
    }

    private static function isAnagram($firstString, $secondString): bool
    {
        return (count_chars($firstString, 1) == count_chars($secondString, 1));
    }
}
