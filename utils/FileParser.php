<?php

namespace Utils;

class FileParser
{
    public static function parseInputSeparatedByBreakLines(string $filePath): array
    {
        $inputContent = file_get_contents(__DIR__.'/..'.$filePath);

        return explode("\n", $inputContent);
    }

    public static function parseInputSeparatedByComma(string $filePath): array
    {
        $inputContent = file_get_contents(__DIR__.'/..'.$filePath);

        return explode(",", $inputContent);
    }
}