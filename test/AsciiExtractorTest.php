<?php

namespace Test;

use App\AsciiExtractor;
use App\Input;
use PHPUnit\Framework\TestCase;

class AsciiExtractorTest extends TestCase
{
    public function testExtractCharacterMap()
    {
        $input = new Input();
        $extractor = new AsciiExtractor($input);

        self::assertEquals(
            [
                '### ',
                '#   ',
                '##  ',
                '#   ',
                '### ',
            ],
            $extractor->get('E')
        );

        self::assertEquals(
            [
                '### ',
                '  # ',
                ' #  ',
                '#   ',
                '### ',
            ],
            $extractor->get('Z')
        );

        self::assertEquals(
            [
                '### ',
                '  # ',
                ' ## ',
                '    ',
                ' #  ',
            ],
            $extractor->get('0')
        );

        self::assertEquals(
            [
                '    ',
                '    ',
                '    ',
                '    ',
                '    ',
            ],
            $extractor->get(' ')
        );
    }
}