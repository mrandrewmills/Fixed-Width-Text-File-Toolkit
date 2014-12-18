<?php

	// start by including the Fixed Width File Toolkit
	require_once 'fixedWidthFileToolkit.class.php';

	// which file are we testing against this time, Brain?
	$testFile = "arrest-11-21-2014.txt";

        // stopwatch
        $startTime = microtime();

	// create a new instance of our utility class
	$myFile = new FixedWidthFile( $testFile );

        // first benchmark
        $extractTime = microtime();

	// now let's retrieve some info about our test file
	$filename = $myFile->getFilename();
	$headers = $myFile->getHeaders();
	$fileData = $myFile->getfileData();
	$howManyRows = $myFile->getNumRows();

        // second benchmark
        $retrieveTime = microtime();
	
	// convert this to JSON, XML, etc.
	$JSONresult = $myFile->toJSON();
	
        // third benchmark
        $convertTime = microtime();
?>
<!doctype html>
<html>
    <head>
        <title>Fixed Width Text File Toolkit Demo</title>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <style type="text/css">
            body { font-family: 'Open Sans', sans-serif; }
        </style>
    </head>
    <body>
	<h1>Fixed Width Text File Toolkit Demo</h1>

        <ul>
            <li><a href="#headers">Headers</a></li>
            <li><a href="#rawdata">Raw Data (the PHP array)</a></li>
            <li><a href="#JSON">JSON conversion</a></li>
        </ul>
	
    <?php	
	// let's show some feedback now
	echo "<p>The filename specified was: <a href='$filename' target='_blank'>$filename</a></p>";
	echo "<p>We retrieved " . $howManyRows . " rows of information from it. </p>";

        echo "<h2>Benchmarks</h2>";
        echo "<p>Started At: " . $startTime . "</p>";
        echo "<p>Extraction Time (microseconds): " . ( $extractTime - $startTime ) . "</p>";
        echo "<p>Retrieved Time (microseconds): " . ( $retrieveTime - $extractTime ) . "</p>";
        echo "<p>Converted Time (microseconds): " . ( $convertTime - $retrieveTime ). "</p>";
	
	echo "<h2><a name='headers'>Headers</a></h2><pre>"; 
	print_r( $headers );
	echo "</pre>";
			
	echo "<h2><a name='rawdata'>Data</a></h2><pre>";
	print_r( $fileData );
	echo "</pre>";
		
	echo "<h2><a name='JSON'>JSON</a></h2>" . $JSONresult;

    ?>
</body>
</html>