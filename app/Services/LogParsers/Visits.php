<?php

namespace App\Services\LogParsers;

/**
 * Gets visits for each url
 */
class Visits implements LogParserInterface
{
    /**
     * @inheritDoc
     */
    public function getHeader(): array
    {
        return ['URI', 'Visits'];
    }

    /**
     * @inheritDoc
     */
    public function parse(\Generator $file) : array
    {
        $data = [];
        while($line = $file->current()) {
            $line = explode(' ', $line);
            if (!isset($data[$line[0]])) {
                $data[$line[0]] = 0;
            }
            $data[$line[0]]++;
            $file->next();
        }
        arsort($data);
        array_walk($data, function (&$value, $key) {
            $value = [$key, $value];
        });
        return $data;
    }
}
