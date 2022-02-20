<?php

interface ProcessorInterface
{
    /**
     * Loads the values from the input into an array
     * @return ProcessorInterface for chaining
     */
    public function loadInputValues(): static;
    
    /**
     * Runs the outlined processes on the luhnHandler and builds our output values array
     * @param LuhnInterface $luhnHandler 
     * @return ProcessorInterface for chaining
     */
    public function processInput(LuhnInterface $luhnHandler): static;

    /**
     * Writes the output. 
     */
    public function writeOutput(): void;

    /**
     * Returns the success message
     */
    public function getSuccessMessage(): string;
}
