#FIXED WIDTH TEXT FILE TOOLKIT

Imagine this: You want to work with Open Data from a local/state/federal agency, but the specific data you want comes in only one format-- fixed width text files. 

Why couldn't it be JSON? Or XML?

Even if it were CSV you wouldn't be spending your afternoon writing custom code to:

	* grab the field names from the header row 
	* do a series of string splits at a, b, c, d, etc. starting character positions 
	* loading the data into an array to encode/transform it to a more usable format

I created the "Fixed Width Text File Toolkit" so I'd have a set of useful functions that could quickly and easily analyze a fixed width text file, grab the field names from the header row, "automagically" (sic) determine the starting character position for each data field, and then convert that data into a multi-dimensional array.

## Contents

[Frequently Asked Questions](#frequently-asked-questions)

[Tutorial](#tutorial)

##Frequently Asked Questions#

Q. WHY DID YOU MAKE THIS WHEN THERE ARE ALREADY OTHER TOOLS/PRODUCTS AVAILABLE?

A. I made this because I wanted to learn more about text-processing functions within PHP and wanted reusable code to deal with Fixed Width Text Files. I decided to share it with others because I'd like to see them improve upon my code and take it in directions that never would have occurred to me.

Q. CAN THIS TOOLKIT WORK WITH REMOTE FILES OVER HTTP:// OR HTTPS://?

A. This toolkit is intended for *local* files, _not remote_ ones. 

Q. CAN YOU ADD FEATURE X, Y OR Z?

A. It depends on the specifics of the feature, whether it makes sense to be part of this toolkit, and how difficult it would be to implement. Drop me a line explaining what you have in mind, and we can discuss it. However, just because I might not have time or inclination to add a feature that you want, that does not mean you can't add it yourself.

Q. MY TEXTFILE(S) DO(ES) NOT HAVE HEADER ROWS. WILL THIS TOOLKIT HANDLE THAT?

A. Yes. Learn more about the hasHeaderRow() method in the tutorial below.

##Tutorial

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

The default configuration options are:

* Your text file has a header row.
* No single line in your text file exceeds 4,096 characters.

At this point, the toolkit will read the file, parse the header row into columns and convert the data into an array of objects. The amount of time it takes to accomplish this will depend upon many factors, such as how many rows are in the text file, how much RAM you have available, etc.  I've tested it with a 17MB text file that contained 50,000 lines and it can parse that in well under four seconds.

You can retrieve the array of objects fairly easily, like this:

```html
	$PHPresult = $myFile->getfileData();
```

What if our textfile does not have a header row, and/or it has exceptionally long lines in it? No problem.

You can easily override the default configuration options with method calls before opening the textfile:

```html
	$myFile = new FixedWidthFile();
	$myFile->setLineLength( 8000 );        // for long lines of text
	$myFile->setHasHeaderRow( false );     // for files that do not have a header row
	$myFile->setFilename( "example.txt" ); // this should always come last
```

*Note: You can also pass these configuration details into your constructor call, if you prefer conciseness to readability.*

```html
	$myFile = new FixedWidthFile( "example.txt", 3000, false );
```


Or maybe you don't need to manipulate that information at all? Perhaps you just want to convert it to JSON for some AJAX message. The toolkit can do that, too:

```html
	$JSONresult = $myFile->toJSON();
```
