<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FileReader;

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        FileReader $fileReader
    ) {
        parent::__construct();
        $this->fileReader = $fileReader;
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
            $container = app();
            /** @var \App\Services\LogParsers\LogParserInterface $parser */
            foreach ($container->tagged('LogParsers') as $parser) {
                $this->table($parser->getHeader(), $parser->parse($this->fileReader->read($logfile)));
            }
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
