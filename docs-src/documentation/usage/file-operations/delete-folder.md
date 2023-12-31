# Delete File

## Method

```php
$api->delete_folder
```

## Parameters

* **repo_id**: The ID of the repository on the Hugging Face Hub. Usually in the form of username/repository_name.
* **path**: Path in repo to delete
* **repo_type**: The repo type. Defaults to model. Can be:
  * model
  * dataset
  * space
* **commit_message**: Commit message. Default: `Delete File`
* **commit_description**: Extra description for commit message. Defaults to null
* **revision**: The branch to use. Defaults to `main`.

## Example

Delete the `test` folder from the dataset `username/repo`:

```php
<?php
include 'hub.php';
$api = new Hub('hf_***');
$api->delete_folder('username/repo', 'test', 'dataset');
```