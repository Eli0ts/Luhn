<?php


/**
 * =======================================================================
 * YOUR REQUEST
 * =======================================================================
 * Write a program that reads an array of 9 digit numbers from a file, 
 * filters out invalid values according to luhn algorithm (https://en.m.wikipedia.org/wiki/Luhn_algorithm) 
 * and stores them in a new file
 */

/**
 * =======================================================================
 * APPROACH
 * =======================================================================
 * Admittedly, it took me some time to work out exactly what you were asking to do.
 * I have never dealt with Luhn before and was unsure what the intended outcome should be.
 * 
 * The code in Luhn::generateLuhnChecksum() has effectively been replicated.
 * Having searched for an implementation of a working example, it is what I came across and having worked out what it was doing, 
 * I would have essentially just ended up rewriting it so took it as it appeared and worked it into the class. It is credited in the comments
 */

/**
 * =======================================================================
 * ASSUMPTIONS
 * =======================================================================
 * I have made some assumptions. Namely that the script will be run from the command line and the argument for the input file will be passed.
 * The output file can be passed also but this is optional and if it's not supplied it will default to files/output.txt
 * I considered making the input file optional also but figured it unlikelyt that such a script would be used for only one particular file in one particularly specific place.
 * In hindsight, I guess it wouldn't have hurt.
 * 
 * I also assume that exception handling is in place further up the stack since
 * I don't want to catch exceptions at this level
 */

/**
 * =======================================================================
 * USAGE
 * =======================================================================
 * I am running the script like so... php luhn.php files/input.txt
 * Dummy numbers are stored in the specified file
 */

require_once('classes/ProcessorInterface.php');
require_once('classes/AbstractProcessor.php');
require_once('classes/Processor_File.php');
require_once('classes/LuhnInterface.php');
require_once('classes/Luhn.php');

$inputFile = $argv[1] ?? null;
$outputFile = $argv[2] ?? null;
$processor = new Processor_File($inputFile,$outputFile);

$processor->loadInputValues();
$processor->processInput(new Luhn);
$processor->writeOutput($outputFile);

echo $processor->getSuccessMessage();
exit;
