<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FileReader;
use App\Services\LogParser;

/**
 * @see $description
 */
class ParseLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:log {logfile=webserver.log}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses webserver log and provides sorted info about visits and unique visits';

    /**
     * @var FileReader
     */
    private $fileReader;

    /**
     * @var LogParser
     */
    private $logParser;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        FileReader $fileReader,
        LogParser $logParser
    ) {
        parent::__construct();
        $this->fileReader = $fileReader;
        $this->logParser = $logParser;
    }

    /**
     * Sorts and reduces the array by given key
     *
     * @param array $data
     * @param string $key
     * @return array
     */
    private function sortReduceByKey(array $data, string $key) : array {
        usort($data, function ($a, $b) use ($key) {
            return $a[$key] < $b[$key];
        });
        array_walk($data, function (&$value) use ($key) {
            $value = [$value['uri'], $value[$key]];
        });
        return $data;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $logfile = $this->argument('logfile');
            $file = $this->fileReader->read($logfile);
            $data = $this->logParser->parse($file);
            $this->table(['URI', 'Visits'], $this->sortReduceByKey($data, 'visits'));
            $this->table(['URI', 'Unique Visits'], $this->sortReduceByKey($data, 'uniqueVisits'));
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
