<?php

namespace Test;

use App\Input;
use PHPUnit\Framework\TestCase;

class InputTest extends TestCase
{
    public function testSimpleInput(): void
    {
        self::assertEquals('4', Input::DEFAULT_WIDTH_LETTER);
        self::assertEquals(
            [
                ' #  ##   ## ##  ### ###  ## # # ###  ## # # #   # # ###  #  ##   #  ##   ## ### # # # # # # # # # # ### ### ',
                '# # # # #   # # #   #   #   # #  #    # # # #   ### # # # # # # # # # # #    #  # # # # # # # # # #   #   # ',
                '### ##  #   # # ##  ##  # # ###  #    # ##  #   ### # # # # ##  # # ##   #   #  # # # # ###  #   #   #   ## ',
                '# # # # #   # # #   #   # # # #  #  # # # # #   # # # # # # #    ## # #   #  #  # # # # ### # #  #  #       ',
                '# # ##   ## ##  ### #    ## # # ###  #  # # ### # # # #  #  #     # # # ##   #  ###  #  # # # #  #  ###  #  ',
            ],
            Input::DEFAULT_ASCII_MAP
        );
    }
}
