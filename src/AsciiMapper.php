<?php

namespace App;

class AsciiMapper
{
    private AsciiExtractor $extractor;

    public function __construct(Input $input)
    {
        $this->extractor = new AsciiExtractor($input);
    }

    public function map(string $word): string
    {
        if (empty($word)) return '';

        $asciiChar = $this->buildChainOfAsciiChars($word);

        return $asciiChar->print();
    }

    private function buildChainOfAsciiChars(string $word): AsciiChar
    {
        $asciiChar = null;
        foreach ($this->getReversedUpperWordAsCharacterList($word) as $character) {
            $asciiChar = new AsciiChar($this->extractor->get($character), $asciiChar);
        }

        return $asciiChar;
    }

    /**
     * @return string[]
     */
    private function getReversedUpperWordAsCharacterList(string $word): array
    {
        $upperWord = strtoupper($word);
        $reversedUpperWord = strrev($upperWord);

        return str_split($reversedUpperWord);
    }
}