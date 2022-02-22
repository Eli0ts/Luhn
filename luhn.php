<?php
/**
 * =======================================================================
 * REQUEST
 * =======================================================================
 * Write a program that reads an array of 9 digit numbers from a file, 
 * filters out invalid values according to luhn algorithm (https://en.m.wikipedia.org/wiki/Luhn_algorithm) 
 * and stores them in a new file
 */

use Luhn\Handler\Luhn;
use Luhn\Processor\Processor_File;

require 'vendor/autoload.php';

$inputFile = $argv[1] ?? null;
$outputFile = $argv[2] ?? null;
$processor = new  Processor_File($inputFile, $outputFile);

$processor->loadInputValues();
$processor->processInput(new Luhn);
$processor->writeOutput();

echo $processor->getSuccessMessage();
exit;
