<?php
	
	class FixedWidthFile {
		private $filename;
		private $headers;

		public function readHeaderRow($filename){

			$this->filename = $filename;

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
			}
		}

		public function dumpHeaders(){
			
			echo "<pre>"; 
			echo var_dump($this->headers);
			echo "</pre>";
		}
		
		public function getDataOut($filename){
			
			$this->filename = $filename; // short term shortcut
			
			// verify file exists, no typos, etc.
			if (file_exists($this->filename)) {
				
				// open the file
				$handle = @fopen($filename, "r");
				
				// if we were successful in opening the file
				if ($handle) {
					
					// then bypass the first line
					$firstRow = fgets($handle, 4096);
					
					// and process the remaining rows of the file
					while (($buffer = fgets($handle, 4096)) !== false) {
        				// echo "<p>$buffer</p>";
						// TODO: parse file based on character positions
						$numFields = count($this->headers);
						
						echo "<p>";
						
						$fieldLength = strlen($buffer);

						for ($x = $numFields - 1; $x > 0; $x--) {
							echo "<strong>" . $this->headers[$x][0] . ":</strong> ";
							$fieldLength = $fieldLength - $this->headers[$x][1];
							echo substr($buffer, $this->headers[$x][1], $fieldLength);
							echo "( $fieldLength characters out of $totalLength total)";
							echo "<br />";
							$fieldLength = $this->headers[$x][1];
							}
						echo "</p>";
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

	}
?>