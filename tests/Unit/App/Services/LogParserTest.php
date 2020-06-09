<?php

namespace Tests\Unit\App\Services;

use PHPUnit\Framework\TestCase;

class LogParserTest extends TestCase
{
    /**
     * @return void
     */
    public function testParse()
    {
        $file = function () {
            $arr = ['/1 1','/1 1','/2 2'];
            foreach ($arr as $value) {
                yield $value;
            }
        };
        $logParser = new \App\Services\LogParser();
        $result = $logParser->parse($file());
        $this->assertEquals(
            '[{"visits":2,"uniqueVisits":1,"uri":"\/1"},{"visits":1,"uniqueVisits":1,"uri":"\/2"}]',
            json_encode($result)
        );
    }
}
