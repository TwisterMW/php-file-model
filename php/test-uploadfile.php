<?php
  $file = new FileModel($_FILES["testfile"], false); // $isGallery is set to false so the uploaded will be named as the original file
  $file = new FileModel($_FILES["testfile"], true); // $isGallery is set to true so the uploaded will be named as 'file' + timestamp
  
  $file->getFileName(true); // It will output the original filename
  
  $file->getFileSize(null, true); // It will output the original size of file in KB by default
  $file->getFileSize("mb", true); // It will output the size of file in MB
  
  $file->getFileType(true); // It will output the original file type (png, jpg, mp3, ...)
  
  $file->getFileSizeUnits(true); // It will output the units used for displaying the file size
  
  // Uploading the file to a specific directory
  $path = "files/";
  $file->uploadFile($path);
?>
