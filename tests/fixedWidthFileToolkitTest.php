<?php

  require_once 'PHPUnit/Autoload.php';
  include 'fixedWidthFileToolkit.class.php';

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
?>
