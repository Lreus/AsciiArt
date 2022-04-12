<?php

namespace App;

class AsciiChar
{
    /**
     * @var string[]
     */
    private array $pattern;
    private ?AsciiChar $nextChar;

    public function __construct(array $pattern, AsciiChar $nextChar = null)
    {
        $this->pattern = $pattern;
        $this->nextChar = $nextChar;
    }

    public function print(): string
    {
        $result = '';
        foreach ($this->pattern as $rowNumber => $line) {
            $result .= $this->printRow($rowNumber) . "\n";
        }

        return $result;
    }

    public function printRow(int $rowNumber): string
    {
        $selfRow = $this->pattern[$rowNumber];

        if ($this->nextChar === null) return $selfRow;

        return $selfRow . $this->nextChar->printRow($rowNumber);
    }
}