<?php

namespace Luhn\Processor;

use Luhn\Handler\LuhnInterface;

abstract class AbstractProcessor implements ProcessorInterface
{
    protected array $inputValues;
    protected array $outputValues = [];
    protected string $outputFile;

    /**
     * Runs the outlined processes on the luhnHandler and builds our output values array
     * @param LuhnInterface $luhnHandler 
     * @return ProcessorInterface for chaining
     */
    public function processInput(LuhnInterface $luhnHandler): static
    {
        foreach ($this->inputValues as $n) {

            if ($luhnHandler->baseNumIsValid($n)) {

                $luhnHandler->setBaseNum($n)
                    ->setBaseCheckSum()
                    ->setBaseValue()
                    ->generateLuhnChecksum();

                if ($luhnHandler->validate()) {
                    $this->outputValues[] = $luhnHandler->getBaseNum();
                }
            }
        }

        return $this;
    }
}
