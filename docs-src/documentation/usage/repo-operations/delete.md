# Delete Repository

## Method

```php
$api->delete_repo
```

## Parameters

* **repo_id**: The ID of the repository on the Hugging Face Hub. Usually in the form of username/repository_name.
* **repo_type**: The repo type. Defaults to model. Can be:
  * model
  * dataset
  * space

## Example

Delete a repository under `username` named `repo`:

```php
<?php
include 'hub.php';
$api = new Hub('hf_***');
$api->delete_repo('username/repo', 'model');
```
