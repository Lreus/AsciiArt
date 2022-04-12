<?php

namespace App;

class Input
{
    public const DEFAULT_ASCII_MAP = [
        ' #  ##   ## ##  ### ###  ## # # ###  ## # # #   # # ###  #  ##   #  ##   ## ### # # # # # # # # # # ### ### ',
        '# # # # #   # # #   #   #   # #  #    # # # #   ### # # # # # # # # # # #    #  # # # # # # # # # #   #   # ',
        '### ##  #   # # ##  ##  # # ###  #    # ##  #   ### # # # # ##  # # ##   #   #  # # # # ###  #   #   #   ## ',
        '# # # # #   # # #   #   # # # #  #  # # # # #   # # # # # # #    ## # #   #  #  # # # # ### # #  #  #       ',
        '# # ##   ## ##  ### #    ## # # ###  #  # # ### # # # #  #  #     # # # ##   #  ###  #  # # # #  #  ###  #  ',
    ];
    public const DEFAULT_WIDTH_LETTER = 4;

    private int $widthLetter;
    /** @var string[] */
    private array $map;

    public function __construct(array $rows = null, int $widthLetter = null)
    {
        $this->map = $rows ?? self::DEFAULT_ASCII_MAP;
        $this->widthLetter = $widthLetter ?? self::DEFAULT_WIDTH_LETTER;
    }

    public function getMap(): array
    {
        return $this->map;
    }

    public function getWidthLetter(): int
    {
        return $this->widthLetter;
    }
}
