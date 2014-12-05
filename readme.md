#FIXED WIDTH TEXT FILE TOOLKIT#

Imagine this: You want to work with Open Data from a local/state/federal agency, but the specific data you want comes in only one format-- fixed width text file. 

Why couldn't it be JSON?

Why couldn't it be XML?

Even if it were CSV you wouldn't be spending your afternoon writing custom code to:

	* grab the field names from the header row 
	* do a series of string splits at a, b, c, d, etc. starting character positions 
	* loading the data into an array to encode/transform it to a more useful format

I created the "Fixed Width Text File Toolkit" so I'd have a set of useful functions that could quickly and easily analyze a fixed width text file, grab the field names from the header row, automagically (sic) determine the starting character position for each data field, and then convert that data over to a more useful format, such as JSON or XML.

##Frequently Asked Questions#

Q. WHY DID YOU MAKE THIS WHEN THERE'S ALREADY "SUCH-AND-SUCH" AVAILABLE?

A. I made this because I wanted to learn more about text-processing functions within PHP and wanted reusable code to deal with Fixed Width Text Files. I decided to share it with others because I'd like to see them improve upon my code and take it in directions that never would have occurred to me.

Q. CAN YOU ADD "SUCH-AND-SUCH" FEATURE?

A. I don't know. It depends on the specifics of the feature, whether it makes sense to be part of this toolkit, and how difficult it would be to implement. Drop me a line explaining what you have in mind, and we can discuss it. However, just because I might not have time or inclination to add a feature that you want, that doesn't mean you can't add it yourself.