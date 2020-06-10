<?php

namespace Tests\Feature\App\Console\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParseLogTest extends TestCase
{
    /**
     * @return void
     */
    public function testSuccess()
    {
        $expected = <<<OUT
+-----+--------+
| URI | Visits |
+-----+--------+
| /1  | 2      |
| /2  | 1      |
+-----+--------+
+-----+---------------+
| URI | Unique Visits |
+-----+---------------+
| /1  | 1             |
| /2  | 1             |
+-----+---------------+
OUT;
        $command = $this->artisan('parse:log', ['logfile' => './tests/Feature/App/Console/Commands/test.log']);
        $expected = explode(PHP_EOL, $expected);
        foreach ($expected as $line) {
            $command->expectsOutput($line);
        }
    }

    /**
     * @return void
     */
    public function testFileNotFound()
    {
        $this->artisan('parse:log', ['logfile' => 'non_existent_file'])
            ->expectsOutput('Error: fopen(non_existent_file): failed to open stream: No such file or directory');
    }
}
