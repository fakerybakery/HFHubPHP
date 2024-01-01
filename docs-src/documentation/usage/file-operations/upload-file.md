# Upload File

!!! warning
    HFHubPHP currently **does not support large files.** Git LFS has not been implemented yet.

## Method

```php
$api->upload_file
```

## Parameters

* **repo_id**: The ID of the repository on the Hugging Face Hub. Usually in the form of username/repository_name.
* **path**: Path in repo to save uploaded file to
* **file**: Path on disk to upload
* **repo_type**: The repo type. Defaults to model. Can be:
  * model
  * dataset
  * space
* **commit_message**: Commit message.
* **commit_description**: Extra description for commit message. Defaults to null
* **revision**: The branch to use. Defaults to `main`.

## Example

Upload `test.txt` from disk and save it as `hello.txt` in the `username/model` model.

```php
<?php
include 'hub.php';
$api = new Hub('hf_***');
$api->upload_file('username/repo', 'hello.txt', 'test.txt');
```
