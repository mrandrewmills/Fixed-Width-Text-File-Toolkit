<?php

	// start by including the Fixed Width File Toolkit
	require_once 'fixedWidthFileToolkit.class.php';

	// create a new instance of the class
	$myFile = new FixedWidthFile();

	// provide filename to readHeadersRow method
	$myFile->readHeaderRow('arrest-9-15-2014.txt');

	// and lets see our results
	$myFile->dumpHeaders();

?>