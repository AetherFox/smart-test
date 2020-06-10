<?php

namespace App\Services\LogParsers;

/**
 * Gets unique visits for each url
 */
class UniqueVisits implements LogParserInterface
{
    /**
     * @inheritDoc
     */
    public function getHeader(): array
    {
        return ['URI', 'Unique Visits'];
    }

    /**
     * @inheritDoc
     */
    public function parse(\Generator $file) : array
    {
        $data = [];
        $hosts = [];
        while($line = $file->current()) {
            $line = explode(' ', $line);
            if (!isset($data[$line[0]])) {
                $data[$line[0]] = 0;
                $hosts[$line[0]] = [];
            }
            if (!in_array($line[1], $hosts[$line[0]])) {
                $data[$line[0]]++;
                $hosts[$line[0]][] = $line[1];
            }
            $file->next();
        }
        arsort($data);
        array_walk($data, function (&$value, $key) {
            $value = [$key, $value];
        });
        return $data;
    }
}
