<?php

namespace Day4;

class BoardDTOFactory
{
    /**
     * @return BoardDTO[]
     */
    public function createMultiple(array $inputLines): array
    {
        $boards = $this->parseInputLines($inputLines);
        $boardDTOs = [];
        foreach ($boards as $boardIndex => $board) {
            $boardDTO = new BoardDTO();
            foreach ($board as $boardLineIndex => $boardLine) {
                $boardDTO->cases[$boardLineIndex] = [];
                foreach ($boardLine as $boardNumber) {
                    $boardNumberDTO = new BoardNumberDTO();
                    $boardNumberDTO->number = intval($boardNumber);
                    $boardDTO->cases[$boardLineIndex][] = $boardNumberDTO;
                }
            }

            $boardDTOs[] = $boardDTO;
        }

        return $boardDTOs;
    }

    private function parseInputLines($inputLines): array
    {
        $inputLines = $this->removeBingoList($inputLines);

        $boards = [];
        $boardIndex = 0;
        foreach ($inputLines as $inputLine) {
            if (!$inputLine) {
                $boardIndex++;
            }
            if (!isset($boards[$boardIndex])) {
                $boards[$boardIndex] = [];
            }
            if ($inputLine) {
                $boardNumbers = explode(" ", $inputLine);
                $boards[$boardIndex][] = array_filter($boardNumbers, fn ($boardNumber) => $boardNumber !== "");
            }
        }

        return $boards;
    }

    private function removeBingoList(array $inputLines): array
    {
        array_shift($inputLines);
        if (!$inputLines[0]) {
            array_shift($inputLines);
        }

        return $inputLines;
    }
}
