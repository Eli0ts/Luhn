<?php

namespace Luhn\Processor;

class Processor_Db extends AbstractProcessor
{
    protected object $dbConn;
    protected array $inputValues;
    protected array $outputValues = [];


    public function __construct(object $dbConn, string $inputsTableName)
    {
        $this->dbConn = $dbConn;
    }

    /**
     * pseudo
     */
    public function loadInputValues(): static
    {
        $this->inputValues = $this->dbConn->fetch();
        return $this;
    }

    /**
     * pseudo
     */
    public function writeOutput(): void
    {
        $this->dbConn->insert('tableName', ...$this->outputValues);
    }

    /**
     * pseudo
     */
    public function getSuccessMessage(): string
    {
        return "Database updated";
    }
}
