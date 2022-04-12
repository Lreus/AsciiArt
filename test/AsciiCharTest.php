<?php

namespace Test;

use App\AsciiChar;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class AsciiCharTest extends TestCase
{
    public function testPrintPatternLineByLine(): void
    {
        $asciiChar = new AsciiChar(
            [
                '### ',
                '#   ',
                '##  ',
                '#   ',
                '### ',
            ]
        );

        self::assertEquals(
            "### \n".
            "#   \n".
            "##  \n".
            "#   \n".
            "### \n",
            $asciiChar->print()
        );
    }

    public function testPrintAttachedNextChar(): void
    {
        $nextChar = new AsciiChar(
            [
                '### ',
                '#   ',
                '##  ',
                '#   ',
                '### ',
            ]
        );

        $firstChar = new AsciiChar(
            [
                '# # ',
                '### ',
                '### ',
                '# # ',
                '# # ',
            ],
            $nextChar
        );

        self::assertEquals(
            "# # ### \n".
            "### #   \n".
            "### ##  \n".
            "# # #   \n".
            "# # ### \n",
            $firstChar->print()
        );
    }
}