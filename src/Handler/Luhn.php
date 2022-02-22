<?php

namespace Luhn\Handler;

class Luhn implements LuhnInterface
{
    private const ALLOWED_CHARACTERS = 9;
    private string $baseNum;
    private string $baseCheckSum;
    private string $baseValue;
    private string $luhnChecksum;

    /**
     * Only allowing numeric value of 'n' characters
     * @param string $num -- the number we want to evaluate
     * @return bool -- true if the value is numeric and contains only 'n'' characters else false
     */
    public function baseNumIsValid(string $num): bool
    {
        return \is_numeric($num) && \strlen(\trim($num)) === self::ALLOWED_CHARACTERS;
    }

    /**
     * Removes the erroneous trailing space seemingly introduced by file()
     * @param string $num -- the number we want to store for evaluation
     * @return Luhn -- returns our object for chaining
     */
    public function setBaseNum(string $num): static
    {
        $this->baseNum = \trim($num);
        return $this;
    }

    /**
     * Returns the base value we were supplied in the beginning in the event of a successful validation
     * @return string $baseNum -- returns the numer we were originally passed
     */
    public function getBaseNum(): string
    {
        return $this->baseNum;
    }

    /**
     * Stores the last character for evaluation later
     * @return Luhn -- returns our object for chaining
     */
    public function setBaseCheckSum(): static
    {
        $this->baseCheckSum = \substr($this->baseNum, -1);
        return $this;
    }

    /**
     * Removes the last charcter for generating the luhn checksum
     * @return Luhn -- returns our object for chaining
     */
    public function setBaseValue(): static
    {
        $this->baseValue =  \substr($this->baseNum, 0, -1);
        return $this;
    }

    /**
     * Generates a checksum to check our intiial values against
     * NOTE:: sourced https://www.hashbangcode.com/article/create-checksums-using-luhn-algorithm-php
     * @return Luhn -- returns our object for chaining
     */
    public function generateLuhnChecksum(): static
    {
        $length = \strlen($this->baseValue);
        $parity = $length % 2;
        $sum = 0;

        for ($i = ($length - 1); $i >= 0; --$i) {

            $char = $this->baseValue[$i];

            if ($i % 2 != $parity) {
                $char *= 2;
                if ($char > 9) {
                    $char -= 9;
                }
            }

            $sum += $char;
        }

        $this->luhnChecksum = ($sum * 9) % 10;

        return $this;
    }

    /**
     * Validates whether or not our original checksum and the luhn checksum match
     * @return bool true if the values correspond else false
     */
    public function validate(): bool
    {
        return $this->baseCheckSum === $this->luhnChecksum;
    }
}
