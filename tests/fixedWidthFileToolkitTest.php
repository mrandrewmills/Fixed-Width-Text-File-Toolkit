<?php

  include 'fixedWidthFileToolkit.class.php';

class fixedWidthFileToolkitTest extends PHPUnit_Framework_TestCase{

  public function testFilename(){
    $myFile = new FixedWidthFile("example.txt");
  }
}
?>
