<?php

namespace Day4\Puzzle1;

use Day4\BoardDTO;
use Day4\BoardDTOFactory;
use Utils\FileParser;

class Solver
{
    /**
     * @var BoardDTO[]
     */
    protected array $boardDTOs;

    protected array $bingoList;

    public function __construct(string $filePath)
    {
        $inputContent = FileParser::parseInputSeparatedByBreakLines($filePath);

        $boardDTOFactory = new BoardDTOFactory();
        $this->boardDTOs = $boardDTOFactory->createMultiple($inputContent);
        $this->bingoList = $this->getBingoList($inputContent);
    }

    public function solve(): int
    {
        foreach ($this->bingoList as $bingoNumber) {
            $this->markAllBingoNumberDTOs($bingoNumber);

            foreach ($this->boardDTOs as $boardDTOIndex => $boardDTO) {
                if ($this->hasBoardWon($boardDTO)) {
                    $winningBoardUnmarkedNumberSum = $this->sumUnmarkedBoardNumber($boardDTO);

                    return $winningBoardUnmarkedNumberSum * $bingoNumber;
                }
            }
        }

        throw new \Exception('Bingo machine might be broken, no boards won :\'( ...');
    }

    private function getBingoList($inputContent): array
    {
        $bingoListAsStrings = explode(",", array_shift($inputContent));

        return array_map(fn (string $bingoNumber) => intval($bingoNumber), $bingoListAsStrings);
    }

    protected function markAllBingoNumberDTOs(int $bingoNumber): void
    {
        foreach ($this->boardDTOs as $boardDTO) {
            foreach ($boardDTO->cases as $boardLine) {
                foreach ($boardLine as $boardNumberDTO) {
                    if ($bingoNumber === $boardNumberDTO->number) {
                        $boardNumberDTO->isMarked = true;
                    }
                }
            }
        }
    }

    public function hasBoardWon(BoardDTO $boardDTO): bool
    {
        return $this->hasBoardWonInLine($boardDTO) || $this->hasBoardWonInColumn($boardDTO);
    }

    private function hasBoardWonInLine(BoardDTO $boardDTO): bool
    {
        foreach ($boardDTO->cases as $boardLine) {
            $isAllLineMarked = true;
            foreach ($boardLine as $boardNumberDTO) {
                if (!$boardNumberDTO->isMarked) {
                    $isAllLineMarked = false;
                }
            }
            if ($isAllLineMarked) {
                return true;
            }
        }

        return false;
    }

    private function hasBoardWonInColumn(BoardDTO $boardDTO): bool
    {
        foreach ($boardDTO->cases as $columnIndex => $boardLine) {
            $isAllColumnMarked = true;
            foreach ($boardLine as $lineIndex => $boardNumberDTO) {
                if (!$boardDTO->cases[$lineIndex][$columnIndex]->isMarked) {
                    $isAllColumnMarked = false;
                }
            }
            if ($isAllColumnMarked) {
                return true;
            }
        }

        return false;
    }

    protected function sumUnmarkedBoardNumber(BoardDTO $boardDTO)
    {
        $numberSum = 0;

        foreach ($boardDTO->cases as $boardLine) {
            foreach ($boardLine as $boardNumberDTO) {
                if (!$boardNumberDTO->isMarked) {
                    $numberSum += $boardNumberDTO->number;
                }
            }
        }


        return $numberSum;
    }
}
