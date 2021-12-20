<?php

namespace Day6\Puzzle1;

use Utils\FileParser;

class Solver
{
    protected array $fishInternalTimers = [];

    public function __construct(string $filePath)
    {
        $inputContent = FileParser::parseInputSeparatedByComma($filePath);
        $this->fishInternalTimers = array_map(fn (string $fishInternalTimer) => (int) $fishInternalTimer, $inputContent);
    }

    public function solve(int $timeExperienceInDays): int
    {
        for($day = 1; $day <= $timeExperienceInDays; $day ++) {
            foreach($this->fishInternalTimers as $fishInternalTimerKey => $fishInternalTimer) {
                if ($fishInternalTimer !== 0) {
                    $this->fishInternalTimers[$fishInternalTimerKey] = $this->fishInternalTimers[$fishInternalTimerKey] - 1;
                } else {
                    $this->fishInternalTimers[$fishInternalTimerKey] = 6;
                    $this->fishInternalTimers[] = 8;
                }
            }
        }

        return count($this->fishInternalTimers);
    }
}
