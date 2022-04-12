<?php

namespace App;

class AsciiExtractor
{
    /**
     * @var string[]
     */
    private array $asciiDictionary;

    const STRING_PATTERN = "ABCDEFGHIJKLMNOPQRSTUVWXYZ?";
    private int $widthLetter;

    public function __construct(Input $input)
    {
        $this->asciiDictionary = $input->getMap();
        $this->widthLetter = $input->getWidthLetter();
    }

    /**
     * @return string[]
     */
    public function get(string $char): array
    {
        if ($char === ' ') return $this->buildSpace();

        if ($this->isUnsupportedChar($char)) $char = '?';
        $offset = $this->getOffsetLetter($char);

        return $this->getLetterMap($offset);
    }

    /**
     * @return string[]
     */
    public function buildSpace(): array
    {
        $height = count($this->asciiDictionary);
        $line = str_repeat(' ', $this->widthLetter);

        return array_fill(0, $height, $line);
    }

    /**
     * @param string $char
     * @return bool
     */
    public function isUnsupportedChar(string $char): bool
    {
        return !str_contains(self::STRING_PATTERN, $char);
    }

    public function getOffsetLetter(string $character): int
    {
        $index = strpos(self::STRING_PATTERN, $character);

        return $index * $this->widthLetter;
    }

    /**
     * @return string[]
     */
    public function getLetterMap(int $offset): array
    {
        return array_map(
            fn(string $line): string => substr($line, $offset, $this->widthLetter),
            $this->asciiDictionary
        );
    }
}