<?php
/**
 *	Fixed Width Text File Toolkit
 *	https://github.com/mrandrewmills/Fixed-Width-Text-File-Toolkit
 *
 *	PHP class to help extract information from fixed width text files as easily as possible.
 *
 */	
	
	class FixedWidthFile {
	
		// Our properties
	
		private $filename;
		private $headers;
		private $lineLength = 4096; // default value, override with setFileLength() as needed
		private $fileData;
		
		// ToDo: add some kind of error structure that can be accessed for last problem?
		
		// Our constructor function (used class name instead of __constructor to work with older versions of PHP)
		
		function FixedWidthFile($filename) {
			
			// if we received a filename
			if ($filename) { 
			
				// pass it on to the setter function 
				$this->setFilename($filename); 
			}
			
		}
		
		// Our getters, no surprises here
		
		public function getFilename(){
			return $this->filename;
		}
		
		public function getHeaders(){
			return $this->headers;
		}
		
		public function getLineLength(){
			return $this->lineLength;
		}

		public function getfileData(){
			return $this->fileData;
		}
		
		public function getNumRows(){
			$numRows = 0;
			
			if ($this->fileData) {
				$numRows = count($this->fileData);
			}
			
			return $numRows;
		}

		// Our setters, but some of our properties are not meant to be accessible (i.e. internal use only)

		public function setFilename($filename){
		
			// verify file exists 
			if (file_exists($filename)) {

				// set the filename property accordingly
				$this->filename = $filename;
							
				// attempt to read the header row
				$this->readHeaderRow();
				
				// attempt to read rest of data file
				$this->readData();
			
				}
				
			else {
				// ToDo: error reporting that file is not valid?
			}
			
			//ToDo: some kind of verification that we can access the file?
			//ToDo: read the header row
			//ToDo: read the data from file into an array
		}
		
		public function setFileLength($fileLength) {
		
			// give developer means to override default fileLength value
			
			if (fileLength) {
				$this->fileLength = $fileLength;
			}
			
		}
		
		// Our "utility functions", for internal use only (thus private)
		
		private function readHeaderRow(){

			/* check to see if file exists */
			if (file_exists($this->filename)) {

				/* if file exists, let's open it! Using @ to suppress error warnings */
				$handle = @fopen($this->filename, "r");

				if ($handle) {
					// read only the first line
				    $firstRow = fgets($handle, 4096);
	
					// parse first row for field names, using two or more consecutive spaces
					$this->headers = preg_split('/(?:\s\s+|\n|\t)/', $firstRow, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE);
				
					// close file when we're done
					fclose($handle);
				}
				else {
					//ToDo: error handling for file permissions issue, etc.
				}
			}
			else {
				// ToDo: error handling for bad file path, typo in filename, etc.
			}
		}
		
		private function readData(){
					
			// verify file exists, no typos, etc.
			if (file_exists($this->filename)) {
				
				// open the file, suppressing any error messages with @
				$handle = fopen($this->filename, "r");
				
				// if we were successful in opening the file
				if ($handle) {
					
					// then bypass the first line
					$firstRow = fgets($handle, 4096);
					
					// and process the remaining rows of the file
					while (($buffer = fgets($handle, 4096)) !== false) {
        					
        					$numFields = count($this->headers);
												
						// find out how long one line is
						$fieldLength = strlen($buffer);
						
						$rowData = Array();

						// working our way BACKWARDS through the array
						for ($x = $numFields - 1; $x >= 0; $x--) {
							
							$fieldLength = $fieldLength - $this->headers[$x][1];
							
							$rowData[$this->headers[$x][0]] = rtrim(substr($buffer, $this->headers[$x][1], $fieldLength));
							
							$fieldLength = $this->headers[$x][1];
							}

						// when we've got the current row sorted, add it to the more permanent pile							
						$this->fileData[] = $rowData;
    				}
    				
				// unexpected file read termination
    				if (!feof($handle)) {
        				echo "Error: unexpected fgets() fail\n";
						// TODO: create more robust error handling
    				}
    				
    				fclose($handle);
				}
			}
			
		}
		
		// Our "Conversion" functions

		public function toJSON(){
			
			$JSONresult = json_encode($this->fileData);
			
			return $JSONresult;
		}
		
		public function toXML(){
			//ToDo: write code to convert PHP arrays into XML
			$XMLresult = "";
			
			return $XMLresult;
		}

		// ToDo: toCSV()? 
		public function toCSV(){
			return true;
		}
		
		// ToDo: toSQL()?
		public function toSQL() {
			return true;
		}
	}
?>