<?php

namespace Day4\Puzzle2;

use Day4\Puzzle1\Solver as Puzzle1Solver;

class Solver extends Puzzle1Solver
{
    private ?int $lastWinningBoardIndex;

    public function __construct(string $filePath)
    {
        $this->lastWinningBoardIndex = null;

        parent::__construct($filePath);
    }

    public function solve(): int
    {
        foreach ($this->bingoList as $bingoNumber) {
            $this->markAllBingoNumberDTOs($bingoNumber);

            foreach ($this->boardDTOs as $boardDTOIndex => $boardDTO) {
                if ($this->hasBoardWon($boardDTO)) {
                    if (count($this->boardDTOs) === 1) {
                        $unmarkedBoardNumberSum = $this->sumUnmarkedBoardNumber($boardDTO);

                        return $bingoNumber * $unmarkedBoardNumberSum;
                    } else {
                        unset($this->boardDTOs[$boardDTOIndex]);
                    }
                }
            }
        }

        throw new \Exception('Bingo machine might be broken, bingo list is not long enough to find last board :\'( ...');
    }
}
