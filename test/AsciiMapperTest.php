<?php

namespace Test;

use App\AsciiMapper;
use App\Input;
use PHPUnit\Framework\TestCase;

class AsciiMapperTest extends TestCase
{
    private function getDefaultInput(): Input
    {
        return new Input(
            [
                ' #  ##   ## ##  ### ###  ## # # ###  ## # # #   # # ###  #  ##   #  ##   ## ### # # # # # # # # # # ### ### ',
                '# # # # #   # # #   #   #   # #  #    # # # #   ### # # # # # # # # # # #    #  # # # # # # # # # #   #   # ',
                '### ##  #   # # ##  ##  # # ###  #    # ##  #   ### # # # # ##  # # ##   #   #  # # # # ###  #   #   #   ## ',
                '# # # # #   # # #   #   # # # #  #  # # # # #   # # # # # # #    ## # #   #  #  # # # # ### # #  #  #       ',
                '# # ##   ## ##  ### #    ## # # ###  #  # # ### # # # #  #  #     # # # ##   #  ###  #  # # # #  #  ###  #  ',
            ],
            4
        );
    }

    private function doTest(string $original, ?Input $input = null): string
    {
        $input = $input ?? $this->getDefaultInput();
        $asciiMapper = new AsciiMapper($input);

        return $asciiMapper->map($original);
    }

    public function testSimpleLetter()
    {
        self::assertEquals(
            "### \n".
            "#   \n".
            "##  \n".
            "#   \n".
            "### \n",
            $this->doTest('E')
        );
    }

    public function testWord()
    {
        self::assertEquals(
            "# #  #  ### # #  #  ### ###  #  ### \n".
            "### # # # # # # # #  #   #  # # # # \n".
            "### ### # # ### ###  #   #  ### # # \n".
            "# # # # # # # # # #  #   #  # # # # \n".
            "# # # # # # # # # #  #   #  # # # # \n",
            $this->doTest('MANHATTAN')
        );
    }

    public function testLowerWord()
    {
        self::assertEquals(
            "# #  #  ### # #  #  ### ###  #  ### \n".
            "### # # # # # # # #  #   #  # # # # \n".
            "### ### # # ### ###  #   #  ### # # \n".
            "# # # # # # # # # #  #   #  # # # # \n".
            "# # # # # # # # # #  #   #  # # # # \n",
            $this->doTest('manhattan')
        );
    }

    public function testWordWithMissingChar()
    {
        self::assertEquals(
            "# # ### ### # # ### ### ### ### ### \n".
            "###   # # # # #   #  #   #    # # # \n".
            "###  ## # # ###  ##  #   #   ## # # \n".
            "# #     # # # #      #   #      # # \n".
            "# #  #  # # # #  #   #   #   #  # # \n",
            $this->doTest('m@nh@tt@n')
        );
    }

    public function testStringWithSpace()
    {
        self::assertEquals(
            "#   ###      ## # #  #  ### \n".
            "#   #       #   # # # #  #  \n".
            "#   ##      #   ### ###  #  \n".
            "#   #       #   # # # #  #  \n".
            "### ###      ## # # # #  #  \n",
            $this->doTest('le chat')
        );
    }

    public function testDifferentCharacterMapping()
    {
        $starInput = new Input(
            [
                ' *  **   ** **  *** ***  ** * * ***  ** * * *   * * ***  *  **   *  **   ** *** * * * * * * * * * * *** *** ',
                '* * * * *   * * *   *   *   * *  *    * * * *   *** * * * * * * * * * * *    *  * * * * * * * * * *   *   * ',
                '*** **  *   * * **  **  * * ***  *    * **  *   *** * * * * **  * * **   *   *  * * * * ***  *   *   *   ** ',
                '* * * * *   * * *   *   * * * *  *  * * * * *   * * * * * * *    ** * *   *  *  * * * * *** * *  *  *       ',
                '* * **   ** **  *** *    ** * * ***  *  * * *** * * * *  *  *     * * * **   *  ***  *  * * * *  *  ***  *  ',
            ],
            4
        );

        self::assertEquals(
            "* *  *  *** * *  *  *** ***  *  *** \n".
            "*** * * * * * * * *  *   *  * * * * \n".
            "*** *** * * *** ***  *   *  *** * * \n".
            "* * * * * * * * * *  *   *  * * * * \n".
            "* * * * * * * * * *  *   *  * * * * \n",
            $this->doTest('MANHATTAN', $starInput)
        );
    }

    public function testDifferentMapSize(): void
    {
        $largeDollarInput = new Input(
            [
                '    $      $$$$$$$    $$$$$$$ $$$$$$$    $$$$$$$$ $$$$$$$$$   $$$$$$$ $       $  $$$$$$$   $$$$$$$  $   $     $         $       $ $$     $   $$$$$$$   $$$$$$$   $$$$$     $$$$$$$   $$$$$$$$ $$$$$$$$$ $       $ $       $ $       $ $      $  $      $  $$$$$$$$$ ',
                '   $ $    $       $  $        $      $  $         $          $        $       $     $         $     $  $      $         $ $   $ $ $  $   $  $       $ $       $ $     $   $       $ $             $     $       $  $     $  $       $   $  $     $    $         $   ',
                '  $   $   $$$$$$$$  $         $       $ $$$$$$    $$$$$$    $     $$$ $$$$$$$$$     $         $     $$$       $         $   $   $ $   $  $  $       $ $$$$$$$$  $   $ $   $$$$$$$$   $$$$$$$      $     $       $   $   $   $   $   $    $$       $  $        $     ',
                ' $ $ $ $  $       $  $        $      $  $         $          $      $ $       $     $      $  $     $  $      $         $       $ $    $ $  $       $ $         $     $   $   $             $     $     $       $    $ $     $ $ $ $    $  $       $        $       ',
                '$       $  $$$$$$$    $$$$$$$ $$$$$$$    $$$$$$$$ $           $$$$$$  $       $  $$$$$$$    $$      $   $     $$$$$$$$$ $       $ $     $$   $$$$$$$  $          $$$$$  $ $     $   $$$$$$$$      $      $$$$$$$      $       $   $   $      $     $      $$$$$$$$$ ',
            ],
            10
        );

        self::assertEquals(
            "$      $      $     $       $  $$$$$$$   $$$$$$$$  $$$$$$$  \n".
            "  $  $       $ $     $     $      $     $         $       $ \n".
            "   $$       $   $     $   $       $     $$$$$$    $$$$$$$$  \n".
            "  $  $     $ $ $ $     $ $        $     $         $   $     \n".
            "$      $  $       $     $      $$$$$$$   $$$$$$$$ $     $   \n",
            $this->doTest('XAVIER', $largeDollarInput)
        );
    }
}