# PHP FileModel
PHP class for managing file uploading.

## USAGE

1) Include the library at top of your PHP document:

```php
include_once("path-to-library/FileModel.php");
```

2) Instantiate the object where you want to treat it:

```php
$file = new FileModel($_FILES["key-of-file"], $isGallery);
```

### Attribute description
- **$file**_($_FILES)_: File to upload. Example = $_FILES["key_of_file"].
- **$isGallery**_(bool)_: Indicates to FileModel if the uploaded file will be stored with other files. In that case the filename will be constructed appending a timestamp at the end of filename for preventing duplication or replacement on future uploadings.

### Methods description
- **uploadFile($destinationPath)**: Method for uploading the file and move it to desired folder
  - **$destinationPath**_(string)_: Folder to upload the file

- **getFileName($print = false)**: Method for get filename
  - **$print**_(bool)_: Indicates if want to print the value. If false, the value will be returned only

- **getFileSize($unit = null, $print = false)**
  - **$unit**_(string)_: Indicates the units that you expect to recieve (b, kb, mb, gb). If leave this value null, it will use KB as default unit.
  - **$print**_(bool)_: Indicates if want to print the value. If false, the value will be returned only

- **getFileType($print = false)**
  - **$print**_(bool)_: Indicates if want to print the value. If false, the value will be returned only

- **getFileSizeUnits($print = false)**
  - **$print**_(bool)_: Indicates if want to print the value. If false, the value will be returned only


## ERROR MANAGEMENT
All errors produced during file upload will be treated by a private method of FileModel class, but you need to ensure that PHP basic configuration is properly set.

If you're having troubles working with big file uploadings, please, check your php.ini file and alter these lines:

  - **upload_max_filesize**=(your limit value)M: This value indicates the value limit of php uploading size
  - **post_max_size**=(your limit value)M: This value indicates the value limit of the php POST size
