<?php

namespace Day6\Puzzle2;

use Utils\FileParser;

class Solver
{
    protected array $fishInternalTimers = [];

    protected array $timersCountIndexedByTimerValues = [];

    public function __construct(string $filePath)
    {
        $inputContent = FileParser::parseInputSeparatedByComma($filePath);
        $this->fishInternalTimers = array_map(fn (string $fishInternalTimer) => (int) $fishInternalTimer, $inputContent);
        $this->setTimersCountIndexedByTimerValues();
    }

    public function solve(int $timeExperienceInDays): int
    {
        for($day = 1; $day <= $timeExperienceInDays; $day ++) {
            $lanternFishesToAddOrResetCount = $this->timersCountIndexedByTimerValues[0];

            foreach($this->timersCountIndexedByTimerValues as $timerValue => $timerCount) {
               if ($timerValue !== 8) {
                   $this->timersCountIndexedByTimerValues[$timerValue] = $this->timersCountIndexedByTimerValues[$timerValue + 1];
               }
            }

            $this->timersCountIndexedByTimerValues[6] += $lanternFishesToAddOrResetCount;
            $this->timersCountIndexedByTimerValues[8] = $lanternFishesToAddOrResetCount;
        }

        return array_sum($this->timersCountIndexedByTimerValues);
    }

    public function setTimersCountIndexedByTimerValues(): void
    {
        for($timerValue = 0; $timerValue <= 8; $timerValue++) {
            $this->timersCountIndexedByTimerValues[$timerValue] = 0;
        }
        foreach($this->fishInternalTimers as $fishInternalTimer) {
            $this->timersCountIndexedByTimerValues[$fishInternalTimer]++;
        }
    }
}
