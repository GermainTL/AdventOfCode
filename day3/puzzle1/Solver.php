<?php

namespace Day3\Puzzle1;

use Utils\FileParser;
use Utils\Helper;

class Solver
{
    private array $diagnosticReports;

    private int $bitsCount;

    public function __construct(string $filePath)
    {
        $this->diagnosticReports = FileParser::parseInputSeparatedByBreakLines($filePath);
        $this->bitsCount = strlen($this->diagnosticReports[0]);
    }

    public function solve(): int
    {
        $gammaRate = $this->computeGammaRate();
        $epsilonRate =  $this->computeEpsilonRate();

        return $gammaRate * $epsilonRate;
    }

    public function computeGammaRate(): int
    {
        $gammaRate = '';
        for($bitPosition = 0; $bitPosition < $this->bitsCount; $bitPosition++)
        {
            $hasMoreZerosThanOne = $this->hasMoreZerosThanOnes($bitPosition);
            $gammaRate .= $hasMoreZerosThanOne ? '0' : '1';
        }

        return bindec($gammaRate);
    }

    public function computeEpsilonRate(): int
    {
        $epsilonRate = '';
        for($bitPosition = 0; $bitPosition < $this->bitsCount; $bitPosition++)
        {
            $hasMoreZerosThanOne = $this->hasMoreZerosThanOnes($bitPosition);
            $epsilonRate .= $hasMoreZerosThanOne ? '1' : '0';
        }

        return bindec($epsilonRate);
    }

    public function hasMoreZerosThanOnes(int $bitPosition): bool
    {
        $zeroCount = 0;
        $oneCount = 0;
        foreach($this->diagnosticReports as $diagnosticReport)
        {
            if (intval(substr($diagnosticReport, $bitPosition, 1) == 0))
            {
                $zeroCount++;
            } else {
                $oneCount++;
            }
        }

        return $zeroCount > $oneCount;
    }
}