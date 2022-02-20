<?php

class Processor_File extends AbstractProcessor
{
    protected string $inputFile;

    protected string $outputFile;
    protected array $inputValues;
    protected array $outputValues = [];


    public function __construct(?string $inputFile, ?string $outputFile)
    {
        if (\is_null($inputFile)) {
            throw new \Exception("You must pass the input file path as a parameter");
        }

        if (!\file_exists($inputFile)) {
            throw new \Exception("The file {$inputFile} does not exist. Please pass a valid existing file.");
        }

        if (\is_null($outputFile)) {
            $this->outputFile = dirname(dirname(__FILE__)) . '/files/output.txt';
        }

        $this->inputFile = $inputFile;
    }


    /**
     * Loads the values from the file into an array
     * @return ProcessorInterface for chaining
     */
    public function loadInputValues(): static
    {
        $this->inputValues = \file($this->inputFile);
        return $this;
    }

    /**
     * Writes the output. If not output file was specified in command, we create a file local to the script called output.txt
     */
    public function writeOutput(): void
    {
        \file_put_contents($this->outputFile, \implode(PHP_EOL, $this->outputValues));
    }

    /**
     * Returns the success message
     */
    public function getSuccessMessage(): string
    {
        return "File processed and output saved to {$this->outputFile}";
    }
}
