<?php
	class FileModel{
		var $file;
		var $name;
		var $type;
		var $size;
		var $unit;
	
		/* ======================================================================================
		/* CONSTRUCTOR
		/* Description: It checks any errors during file upload and initialize attributes
		/* ====================================================================================*/
		function __construct($file, $isGallery){
			if(isset($file)){
				$this->file = $file;
	
				if($file["error"] != 4){
					($isGallery)
						? $this->name = "file" . time()
						: $this->name = str_replace(" ", "", strtolower(pathinfo($file["name"], PATHINFO_FILENAME)));
	
					$this->type = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
					$this->size = round($file["size"] / 1000, 2);
					$this->unit = "kb";
				}else{
					$this->throwError("Error: No file uploaded, try again!");
				}
			}else{
				$this->throwError("Error: No file detected!");
			}
		}
	
		/* ======================================================================================
		/* Method: uploadFile($destinationPath)
		/* Description: Method for move uploaded file to the output path
		/* ====================================================================================*/
		public function uploadFile($destinationPath){
			$outputFile = $destinationPath . "/" . $this->name . "." . $this->type;
	
			if(is_dir($destinationPath) && is_writable($destinationPath)){
				if(move_uploaded_file($this->file["tmp_name"], $outputFile)){
					print_r("File uploaded!");
				}else{
					print_r("Error: Cannot upload the file " . $this->file["error"]);
				}
			}else{
				print_r("Error: Uploading directory is not writable or does not exist!");
			}
		}
	
		/* ======================================================================================
		/* Method: throwError($error)
		/* Description: Method for manage error throwing outputs
		/* ====================================================================================*/
		private function throwError($error){
			print_r($error . "<br />");
		}
	
		/* ======================================================================================
		/* Method: getFileName($print = false)
		/* Description: Method for print/get file name
		/* ====================================================================================*/
		public function getFileName($print = false){
			return $print ? print_r($this->name) : $this->name;
		}
	
		/* ======================================================================================
		/* Method: getFileSize($unit = null, $print = false)
		/* Description: Method for print/get file size
		/* ====================================================================================*/
		public function getFileSize($unit = null, $print = false){
			if($unit != null) $this->unit = strtolower($unit);
			
			$size = $this->size;
	
			switch($this->unit){
				case "b": $size = round($this->size * 1000, 2); break;
				case "mb": $size = round($this->size / 1000, 2); break;
				case "gb": $size = round($this->size / 1000000, 2); break;
			}
	
			return $print ? print_r($size . strtoupper($this->unit)) : $size;
		}
	
		/* ======================================================================================
		/* Method: getFileType($print = false)
		/* Description: Method for print/get file type
		/* ====================================================================================*/
		public function getFileType($print = false){
			return $print ? print_r($this->type) : $this->type;
		}
	
		/* ======================================================================================
		/* Method: getFileSizeUnits($print = false)
		/* Description: Method for print/get file size units
		/* ====================================================================================*/
		public function getFileSizeUnits($print = false){
			return $print ? print_r(strtoupper($this->unit)) : $this->unit;
		}
	}
?>
