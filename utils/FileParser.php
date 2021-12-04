<?php

namespace Utils;

class FileParser
{
    public static function readInputFile(string $filePath): array
    {
        print_r(__DIR__);
        $inputContent = file_get_contents(__DIR__.'/..'.$filePath);

        return explode("\n", $inputContent);
    }
}