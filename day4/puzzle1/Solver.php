<?php

namespace Day4\Puzzle1;

use Utils\FileParser;

class Solver
{
    /**
     * @var BoardDTO[]
     */
    private array $boardDTOs;

    private array $bingoList;

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
                foreach ($boardDTO->cases as $boardLine) {
                    $isAllLineMarked = true;
                    foreach ($boardLine as $boardNumberDTO) {
                        if (!$boardNumberDTO->isMarked) {
                            $isAllLineMarked = false;
                        }
                    }
                    if ($isAllLineMarked) {
                        $winningBoardUnmarkedNumberSum = $this->getWinningBoardUnmarkedNumberSum($boardDTOIndex);

                        return $winningBoardUnmarkedNumberSum * $bingoNumber;
                    }
                }

                foreach ($boardDTO->cases as $boardLine) {
                    for($columnIndex = 0; $columnIndex < count($boardLine); $columnIndex++) {

                        $isAllColumnMarked = true;
                        foreach ($boardLine as $boardNumberIndex => $boardNumberDTO)
                        {
                            if (!$boardNumberDTO->isMarked) {
                                $isAllColumnMarked = false;
                            }
                        }
                        if ($isAllColumnMarked) {
                            $winningBoardUnmarkedNumberSum = $this->getWinningBoardUnmarkedNumberSum($boardDTOIndex);

                            return $winningBoardUnmarkedNumberSum * $bingoNumber;
                        }
                    }
                }
            }
        }

        return 0;
    }

    private function getBingoList($inputContent): array
    {
        $bingoListAsStrings = explode(",", array_shift($inputContent));

        return array_map(fn(string $bingoNumber) => intval($bingoNumber), $bingoListAsStrings);
    }

    private function markAllBingoNumberDTOs(int $bingoNumber): void
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

    private function getWinningBoardUnmarkedNumberSum(int $boardDTOIndex)
    {
        $numberSum = 0;
        $boardDTO = $this->boardDTOs[$boardDTOIndex];

        foreach($boardDTO->cases as $boardLine)
        {
            foreach($boardLine as $boardNumberDTO)
            {
                if (!$boardNumberDTO->isMarked) {
                    $numberSum += $boardNumberDTO->number;
                }
            }
        }


        return $numberSum;
    }
}
