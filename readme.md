# FIXED WIDTH TEXT FILE TOOLKIT

Let's say you want to work with Open Data from a local/state/federal agency, but the data comes in only one format: fixed width text files. 

Why couldn't it be JSON? Or XML?

Even if it were CSV you wouldn't be spending your afternoon writing custom code to:

	* grab the field names from the header row 
	* do a series of string splits at a, b, c, d, etc. starting character positions 
	* loading the data into an array to encode/transform it to a more usable format

I created the "Fixed Width Text File Toolkit" so I could quickly and easily analyze a fixed width text file, grab the field names from the header row, "automagically" (sic) determine the starting character position for each data field, and then convert that data into a multi-dimensional array.

Contents

[Frequently Asked Questions](#frequently-asked-questions)

[Tutorial](#tutorial)

## Frequently Asked Questions

Q. WHY DID YOU MAKE THIS WHEN THERE ARE ALREADY OTHER TOOLS/PRODUCTS AVAILABLE?

A. I wanted to learn more about text-processing functions within PHP and wanted reusable code to deal with Fixed Width Text Files. I decided to share it because I'd like to others improve upon my code and take it in directions that never would have occurred to me.

Q. CAN THIS TOOLKIT WORK WITH REMOTE FILES OVER HTTP:// OR HTTPS://?

A. This toolkit is intended for *local* files, _not remote_ ones. 

Q. CAN YOU ADD FEATURE X, Y OR Z?

A. It depends on the specifics of the feature, whether it makes sense to be part of this toolkit, and how difficult it would be to implement. Contact me to explain what you have in mind, and we can discuss it. However, if I do not have time or inclination to add a feature you want, you can always fork this project to add the feature yourself.

Q. MY TEXTFILE DOES NOT HAVE A HEADER ROW. WILL THIS TOOLKIT HANDLE THAT?

A. Yes. Learn more about the hasHeaderRow() method in the tutorial below.

Q. MY TEXTFILE IS VERY BIG. WILL THIS TOOLKIT HANDLE THAT?

A. Textfiles can be big for two reasons: long line widths and lots of rows. If your textfile has lines that exceed 4,096 characters, you'll want to read up on the setLineLength() method in the tutorial below. If your textfile has lots of rows, then the amount of RAM available to PHP on your computer will determine how large a textfile you can successfully process.

Q. IS IT FAST?

A. I've parsed a 17MB file with 50,000 lines in less than 4 seconds. Your mileage will vary, depending upon how much available RAM your computer has and how large your textfile is.

Q. MY TEXTFILE IS NOT PERFECT. CAN YOUR TOOL HANDLE/FILTER "BAD" DATA?

A. Possibly. Depending upon what exactly is wrong with your data, the setHowStrict() method might help. You can learn more about that in the tutorial below.

## Tutorial

To use the Fixed Width File Toolkit in your PHP script, you first need to include it. Like so:

```html
<?php

	require_once 'fixedWidthFileToolkit.class.php';
```

The next step is to create an instance of the toolkit and tell it which textfile you are interested in.

```html
	$myFile = new FixedWidthFile();
	$myFile->setFilename( "example.txt" );
```

*Note: if the textfile is in a different location than your script, you may need to pass the filename with the path (e.g. "/datafiles/example.txt") instead.*

That will cause the toolkit to load and analyze the text file called "example.txt" with the *default configuration options*. 
The default configuration options assume:

* Your text file has a header row.
* No single line in your text file exceeds 4,096 characters.
* If a line has data that overruns the column it is in or is missing data, skip that line and process the rest.

But what if our textfile does not have a header row?
Or it has exceptionally long lines in it? 
Or it contains "bad" data?

Don't worry, you can easily override the default configuration options with method calls before opening the textfile:

```html
	$myFile = new FixedWidthFile();		// create an instance of the toolkit
	
	$myFile->setLineLength( 8000 );        	// for long lines of text
	$myFile->setHasHeaderRow( false );     	// for files that do not have a header row
	$myFile->setHowStrict("HIGH");		// if line has an empty column, or runs into next column, throw an error.
	
	$myFile->setFilename( "example.txt" ); 	// AFTER the config options are set, THEN you tell it the filename
```

*Note: You can also pass these configuration details into your constructor call, if you prefer conciseness to readability.*

```html
	$myFile = new FixedWidthFile( "example.txt", 8000, false, "HIGH");
```

Once the toolkit knows which textfile you want to work with, it will read that textfile, parse the header row into columns and convert the data into an array of objects. What happens next is up to you, but here are possibile suggestions:

If you want only to convert the extracted textfile data into JSON format, there's a toJSON() method in the toolkit for your convenience.

```html
	$JSONresult = $myFile->toJSON();
```

But if you want to use PHP's [considerable aresenal of array functions](http://php.net/manual/en/ref.array.php) on the array of objects, you will need to retrieve it with the getFileData() method first.

```html
	$PHPresult = $myFile->getfileData();
```
