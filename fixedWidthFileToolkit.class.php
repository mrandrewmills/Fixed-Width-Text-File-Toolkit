<?php
	
	class FixedWidthFile {
		private $filename;
		private $headers;

		public function readHeaderRow($filename){

			$this->filename = $filename;

			/* check to see if file exists */
			if (file_exists($this->filename)) {

				/* if file exists, let's open it! */
				$handle = @fopen($this->filename, "r");

				if ($handle) {
					// read only the first line
				        $firstRow = fgets($handle, 4096);
	
					// parse first row for field names, using two or more consecutive spaces
					$this->$headers = preg_split('/(?:\s\s+|\n|\t)/', $headerRow, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE);
				}
			}
		}

		public function dumpHeaders(){
			
			echo "<pre>" . var_dump($this->headers) . "</pre>";
		}

	}
?>