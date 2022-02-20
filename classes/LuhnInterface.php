<?php

interface LuhnInterface
{
    /**
     * Only allowing numeric value of 'n' characters
     * @param string $num -- the number we want to evaluate
     * @return bool -- true if the value is numeric and contains only 'n' characters else false
     */
    public function baseNumIsValid(string $num): bool;

    /**
     * Removes the erroneous trailing space seemingly introduced by file()
     * @param string $num -- the number we want to store for evaluation
     * @return Luhn -- returns our object for chaining
     */
    public function setBaseNum(string $num): static;

    /**
     * Returns the base value we were supplied in the beginning in the event of a successful validation
     * @return string $baseNum -- returns the numer we were originally passed
     */
    public function getBaseNum(): string;

    /**
     * Stores the last character for evaluation later
     * @return Luhn -- returns our object for chaining
     */
    public function setBaseCheckSum(): static;

    /**
     * Removes the last charcter for generating the luhn checksum
     * @return Luhn -- returns our object for chaining
     */
    public function setBaseValue(): static;


    /**
     * Generates a checksum to check our intiial values against
     * @return Luhn -- returns our object for chaining
     */
    public function generateLuhnChecksum(): static;


    /**
     * Validates whether or not our original checksum and the luhn checksum match
     * @return bool true if the values correspond else false
     */
    public function validate(): bool;
}
