<?php

namespace Day3\Puzzle2;

use Utils\FileParser;
use Utils\Helper;

class Solver
{
    private array $diagnosticReports;

    private int $bitsCount;

    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->diagnosticReports = FileParser::parseInputSeparatedByBreakLines($filePath);
        $this->bitsCount = strlen($this->diagnosticReports[0]);
        $this->filePath = $filePath;
    }

    public function solve(): int
    {
        $oxygenGeneratorRating = $this->computeOxygenGeneratorRating();

        $this->resetDiagnosticReports();

        $CO2ScrubberRating =  $this->computeCO2ScrubberRating();

        return $oxygenGeneratorRating * $CO2ScrubberRating;
    }

    public function computeOxygenGeneratorRating(): int // TODO: duplicated with computeCO2ScrubberRating
    {
        for ($bitPosition = 0; $bitPosition < $this->bitsCount; $bitPosition++) {
            try {
                $hasMoreZerosThanOne = $this->hasMoreZerosThanOnes($bitPosition);
                $this->removeUnwantedDiagnosticReports($hasMoreZerosThanOne ? '0' : '1', $bitPosition);
            } catch (\LogicException $e) {
                $this->removeUnwantedDiagnosticReports('1', $bitPosition);
            }

            if (count($this->diagnosticReports) === 1) {
                return bindec(current($this->diagnosticReports));
            }
        }

        $this->computeOxygenGeneratorRating();
    }

    public function computeCO2ScrubberRating(): int
    {
        for ($bitPosition = 0; $bitPosition < $this->bitsCount; $bitPosition++) {
            try {
                $hasMoreZerosThanOne = $this->hasMoreZerosThanOnes($bitPosition);
                $this->removeUnwantedDiagnosticReports($hasMoreZerosThanOne ? '1' : '0', $bitPosition);
            } catch (\LogicException $e) {
                $this->removeUnwantedDiagnosticReports('0', $bitPosition);
            }

            if (count($this->diagnosticReports) === 1) {
                return bindec(current($this->diagnosticReports));
            }
        }

        $this->computeCO2ScrubberRating();
    }

    public function hasMoreZerosThanOnes(int $bitPosition): bool
    {
        $zeroCount = 0;
        $oneCount = 0;
        foreach ($this->diagnosticReports as $diagnosticReport) {
            if (intval(substr($diagnosticReport, $bitPosition, 1) == 0)) {
                $zeroCount++;
            } else {
                $oneCount++;
            }
        }

        if ($zeroCount === $oneCount) {
            throw new \LogicException(sprintf('Zero count equals one count: %s', $oneCount));
        }
        return $zeroCount > $oneCount;
    }

    private function removeUnwantedDiagnosticReports(string $wantedBit, int $wantedBitPosition): void
    {
        $wantedDiagnosticReports = array_filter(
            $this->diagnosticReports,
            fn (string $diagnosticReport) => intval(substr($diagnosticReport, $wantedBitPosition, 1) === $wantedBit)
        );

        $this->setDiagnosticReports($wantedDiagnosticReports);
    }

    private function setDiagnosticReports(array $diagnosticReports): self
    {
        $this->diagnosticReports = $diagnosticReports;

        return $this;
    }

    private function resetDiagnosticReports(): self
    {
        $this->diagnosticReports = FileParser::parseInputSeparatedByBreakLines($this->filePath);

        return $this;
    }
}
