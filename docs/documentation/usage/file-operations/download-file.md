# Delete File

!!! note
    This method directly streams the incoming data into the file. For large files, the data will be incrementally downloaded and saved. This means that the output file is not complete until the task finishes.

## Method

```php
$api->download_file
```

## Parameters

* **repo_id**: The ID of the repository on the Hugging Face Hub. Usually in the form of username/repository_name.
* **file**: Path in repo to download
* **path**: Path in save the downloaded file to
* **repo_type**: The repo type. Defaults to model. Can be:
  * model
  * dataset
  * space
* **revision**: The branch to use. Defaults to `main`.

## Example

Download `test.txt` from the model `username/repo` and save it to `output.txt`.

```php
<?php
include 'hub.php';
$api = new Hub('hf_***');
$api->download_file('username/repo', 'test.txt', 'output.txt', 'model');
```