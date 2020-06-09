<?php

namespace App\Services;

/**
 * Parses lines one by one filling array with data and collects stats
 */
class LogParser
{
    /**
     * @param \Generator $file
     * @return array
     */
    public function parse(\Generator $file) : array {
        $data = [];
        while($line = $file->current()) {
            $line = explode(' ', $line);
            if (!isset($data[$line[0]])) {
                $data[$line[0]] = [
                    'visits' => 1,
                    'uniqueVisits' => 1,
                    'hosts' => [$line[1]]
                ];
            } else {
                $data[$line[0]]['visits']++;
                if (!in_array($line[1], $data[$line[0]]['hosts'])) {
                    $data[$line[0]]['hosts'][] = $line[1];
                    $data[$line[0]]['uniqueVisits']++;
                }
            }
            $file->next();
        }
        array_walk($data, function (&$value, $key) {
            unset($value['hosts']);
            $value['uri'] = $key;
        });
        return array_values($data);
    }
}
