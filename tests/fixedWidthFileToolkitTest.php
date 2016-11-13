<?php
class fixedWidthFileToolkitTest extends PHPUnit_Framework_TestCase{

  include 'fixedWidthFileToolkit.class.php';

  public function testFilename(){
    $myFile = new FixedWidthFile("example.txt");
  }
}
?>
