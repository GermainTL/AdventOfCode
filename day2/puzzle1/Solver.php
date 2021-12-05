<?php

namespace Day2\Puzzle1;

use Utils\FileParser;
use Utils\Helper;

class Solver
{
    const HORIZONTAL_COMMAND_PREFIX = 'forward';
    const DECREASE_DEPTH_COMMAND_PREFIX = 'up';
    const INCREASE_DEPTH_COMMAND_PREFIX = 'down';

    const ALL_COMMAND_PREFIXES = [self::HORIZONTAL_COMMAND_PREFIX, self::DECREASE_DEPTH_COMMAND_PREFIX, self::INCREASE_DEPTH_COMMAND_PREFIX];

    public static function solve(string $filePath): int
    {
        $inputContent = FileParser::parseInputSeparatedByBreakLines($filePath);

        ['horizontalPosition' => $horizontalPosition, 'depth' => $depth] = self::getPosition($inputContent);

        return $horizontalPosition * $depth;
    }

    public static function getPosition(array $commands): array
    {
        $horizontalPosition = 0;
        $depth = 0;

        foreach($commands as $command) {
            if (Helper::strContains(self::HORIZONTAL_COMMAND_PREFIX, $command)) {
                $horizontalPosition += self::extractValueFromCommand($command, self::HORIZONTAL_COMMAND_PREFIX);
            } elseif (Helper::strContains(self::DECREASE_DEPTH_COMMAND_PREFIX, $command)){
                $depth -= self::extractValueFromCommand($command, self::DECREASE_DEPTH_COMMAND_PREFIX);
            } elseif (Helper::strContains(self::INCREASE_DEPTH_COMMAND_PREFIX, $command)) {
                $depth += self::extractValueFromCommand($command, self::INCREASE_DEPTH_COMMAND_PREFIX);
            } else {
                throw new \InvalidArgumentException(sprintf('Captain, we don\'t know command "%s", what should we do ?', $command));
            }
        }

        return ['horizontalPosition' => $horizontalPosition, 'depth' => $depth];
    }

    public static function extractValueFromCommand(string $command, string $commandPrefix): int
    {
        $commandWithoutPrefix = trim(str_replace($commandPrefix, '',$command));

        return intval($commandWithoutPrefix);
    }
}