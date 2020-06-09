<?php

namespace Tests\Unit\App\Services;

use App\Services\FileReader;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use PHPUnit\Framework\TestCase;

class FileReaderTest extends TestCase
{
    /**
     * @return void
     */
    public function testRead()
    {
        $filesystem = vfsStream::setup();
        $file = new vfsStreamFile('filename.ext');
        $origContent = '123';
        $file->setContent($origContent);
        $filesystem->addChild($file);
        $reader = new FileReader();
        $result = $reader->read($file->url());
        $this->assertEquals(\Generator::class, get_class($result));
        $content = '';
        while ($line = $result->current()) {
            $content .= $line;
            $result->next();
        }
        $this->assertEquals($origContent, $content);
    }
}
