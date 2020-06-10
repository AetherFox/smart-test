<?php

namespace Tests\Unit\App\Services\LogParsers;

use PHPUnit\Framework\TestCase;

class UniqueVisitsTest extends TestCase
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
        $logParser = new \App\Services\LogParsers\UniqueVisits();
        $result = $logParser->parse($file());
        $this->assertEquals(
            '{"\/1":["\/1",1],"\/2":["\/2",1]}',
            json_encode($result)
        );
    }
}
