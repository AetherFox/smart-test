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
    public function testExample()
    {
        //No easy way to test multiline output
        //https://github.com/laravel/framework/pull/32927
        $this->artisan('parse:log', ['./tests/Feature/App/Console/Commands/test.log'])
            ->assertExitCode(0);
    }
}
