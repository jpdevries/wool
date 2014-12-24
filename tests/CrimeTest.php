<?php
/**
 * Tests the Wool class.
 */
class TypeTest extends PHPUnit_Framework_TestCase {
    /** @var Wool $Wool */
    public $wool;
    public $package;

    public function setUp() {
        global $Wool;
        $this->wool = $Wool;
    }

    public function testEllipsis() {
        $input = 'And so on...<br>And so on...<br>And so on...<br>';
        $input = $this->wool->fixEllipsis($input);
        $this->assertTrue(strpos($input,'...') === false,'Occurences of \'...\' found in string.');
    }
    
    public function testCrazyCaps() {
        $input = 'You should totally BUY THIS RIGHT NOW!!!';
        $input = $this->wool->fixCrazyExclamations($input);
        $this->assertTrue(strpos($input,'!!!') === false,'Occurences of \'!!!\' found in string.');
    }
    
    public function testQuotes() {
        $input = 'That’s it.' . "\n ";
        $input .= '"That is what she said." 5\'10"';
        $input = $this->wool->encodeQuotes($input);
        $this->assertTrue(strpos($input,'’') === false || strpos($input,'"') === false,"Nasty quotes found in:\n$input.");
    }
    
    public function testGreedySpaces() {
        $input = 'Here    we all are.';
        $input = $this->wool->fixGreedySpaces($input);
        $this->assertTrue((preg_match('/  +/',$input) === 0),"Duplicate spaces found in:\n$input");
    }
    
    public function testDashes() {
        $input = 'This is not the correct--dash. ';
        $input .= 'This is not the correct-dash either.';
        $input = $this->wool->fixEmDash($input);
        $input = $this->wool->fixEnDash($input);
        $this->assertTrue(strpos($input,'-') === false,"Nasty dashes found in:\n$input");
    }
    
    public function testCopyrightSymbols() {
        $input = 'Copyright 20014(c).';
        $input = $this->wool->fixCopyrightSymbols($input);
        $this->assertTrue(strpos($input,'(c)') === false,"Fake Copyright signs found in:\n$input");
    }
    
    public function testTrademarkSymbols() {
        $input = '<sup>tm</sup>';
        $input = $this->wool->fixTrademarkSymbols($input);
        $this->assertTrue( preg_match('/(<sup>||<sup[^>]+>)TM<\/sup>/i', $input) === 0 ,"Fake Copyright signs found in:\n$input");
    }
    
    public function testPhonyFractions() {
        // phony fractions
        $input  = '1/4 ';
        $input .= '1/2 ';
        $input .= '3/4 ';
        $input .= '1/6' ;
        $input = $this->wool->fixPhonyFractions($input);
        $this->assertTrue( preg_match('/\d\/\d/', $input) === 0 ,"Fake fraction slashes found in:\n$input");
    }
    
    public function testPhonyMultiplicationSings() {
        $input = '5 x 5';
        $input = $this->wool->fixPhonyMultiplicationSigns($input);
        $this->assertTrue( preg_match('/\d\sx\s\d/i', $input) === 0 ,"Fake multiplication signs found in:\n$input");
    }
    
    public function testPhonyDivisionSigns() {
        $input = '5 / 5. 5 % 5.';
        $input = $this->wool->fixPhonyDivisionSigns($input);
        echo "$input\n";
        $this->assertTrue( preg_match('/\d\s%\s\d/i', $input) === 0 ,"Fake division signs found in:\n$input");
    }
    
    public function testDegreeSymbols() {
        $input = '45<sup class="kill">o</sup>yolo';
        $input = $this->wool->fixDegreeSymbols($input);
        $this->assertTrue( preg_match('/(0x)?[0-9]+(<sup>||<sup[^>]+>)o<\/sup>/i', $input) === 0 ,"Fake degree signs found in:\n$input");
    }
    
    public function testEncodeAmpersandes() {
        $input = 'Hello &amp; World.';
        $input = $this->wool->encodeAmpersands($input);
        $this->assertTrue( preg_match('/&(?!amp;)/', $input) === 0 ,"Un-encoded ampersands found in:\n$input");
    }
    
    public function testFixShoutCaps() {
        $input = 'YOU SHOULD TOTALLY BUY THIS RIGHT NOW!!!';
        $input = $this->wool->fixShoutCaps($input);
        $this->assertTrue( preg_match('/\b[A-Z][A-Z]+\b/', $input) === 0 ,"Shout caps found in:\n$input");
    }
    
    public function testFixCrazyCaps() {
        $input = 'YOU SHOULD TOTALLY BUY THIS RIGHT NOW!!!';
        $input = $this->wool->fixCrazyExclamations($input);
        $this->assertTrue( preg_match('/!!\S*/', $input) === 0 ,"Excessive exclamations found in:\n$input");
    }
    
    public function testAdopt() {
        $input = 'The cat jumped over the big red.';
        $ws = explode(' ',$input);
        $t = count($ws);
        $input = $this->wool->adopt($input);
        $ws = explode(' ',$input);
        $this->assertTrue( $t > count($ws) ,"No orphans adopted:\n$input");
    }

}
