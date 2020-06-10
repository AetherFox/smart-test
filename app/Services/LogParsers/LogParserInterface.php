<?php

namespace App\Services\LogParsers;

/**
 * Interface for different log parsers
 */
interface LogParserInterface
{
    /**
     * Gets header for table printing
     *
     * @return array
     */
    public function getHeader() : array;

    /**
     * Parses log line by line, aggregates data and returns data for table printing
     *
     * @param \Generator $file
     * @return mixed
     */
    public function parse(\Generator $file) : array;
}
