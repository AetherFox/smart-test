<?php

namespace App\Services;

/**
 * Class responsible for reading files capable of reading really big ones
 */
class FileReader
{
    /**
     * @param string $path
     * @return \Generator
     */
    public function read(string $path) : \Generator {
        $file = fopen($path, 'r');
        while(!feof($file)) {
            yield fgets($file);
        }
        fclose($file);
    }
}
