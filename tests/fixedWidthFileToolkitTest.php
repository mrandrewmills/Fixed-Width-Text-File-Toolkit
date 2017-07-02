<?php

  include 'fixedWidthFileToolkit.class.php';

  // for PHP7 testing (later version of PHPUnit has namespacing)
  if (PHP_MAJOR_VERSION >= 7) {
    class fixedWidthFileToolkitTest extends \PHPUnit\Framework\TestCase{

      public function testFilename(){
        // create an instance of the FixedWidthFile class
        $myFile = new FixedWidthFile("example.txt");
        // retrieve the filename value
        $result = $myFile->getFilename();
        // compare result vs. expectation for validation
        $this->assertEquals("example.txt", $result);

        // check the default values for lineLength, hasHeaderRow and howStrict
        $result = $myFile->getLineLength();
        $this->assertEquals(4096, $result);
        $result = $myFile->getHasHeaderRow();
        $this->assertEquals(true, $result);
        $result = $myFile->getHowStrict();
        $this->assertEquals("MEDIUM", $result);
      }
    }
  }
  
  if (PHP_MAJOR_VERSION < 7) {
    // for PHP5.6 legacy testing (no namespacing)
    class fixedWidthFileToolkitTest extends PHPUnit_Framework_TestCase{
      public function testFilename(){
        // create an instance of the FixedWidthFile class
        $myFile = new FixedWidthFile("example.txt");
        // retrieve the filename value
        $result = $myFile->getFilename();
        // compare result vs. expectation for validation
        $this->assertEquals("example.txt", $result);
        // check the default values for lineLength, hasHeaderRow and howStrict
        $result = $myFile->getLineLength();
        $this->assertEquals(4096, $result);
        $result = $myFile->getHasHeaderRow();
        $this->assertEquals(true, $result);
        $result = $myFile->getHowStrict();
        $this->assertEquals("MEDIUM", $result);
      }
    }
  }
?>
