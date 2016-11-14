<?php

  include 'fixedWidthFileToolkit.class.php';

class fixedWidthFileToolkitTest extends PHPUnit_Framework_TestCase{

  public function testFilename(){
    // create an instance of the FixedWidthFile class
    $myFile = new FixedWidthFile("example.txt");
    // retrieve the filename value
    $result = $myFile->getFilename();
    // compare result vs. expectation for validation
    $this->assertEquals("example.txt", $result);
  }
}
?>
