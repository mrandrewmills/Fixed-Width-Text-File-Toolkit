<?php

	// start by including the Fixed Width File Toolkit
	require_once 'fixedWidthFileToolkit.class.php';

	// create a new instance of the class
	$myFile = new FixedWidthFile();

	// provide filename to readHeadersRow method
        $myFile->readHeaderRow('arrest-11-21-2014.txt');

	// and lets see our results
	$myFile->dumpHeaders();
	
	// now let's get the data out of the file
	$myFile->getDataOut('arrest-11-21-2014.txt');
	
	// and display the data
	$myFile->dumpDataJSON();

?>