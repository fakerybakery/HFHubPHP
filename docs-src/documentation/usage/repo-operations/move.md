# Move Repository

### Method

```php
$api->move_repo
```

## Parameters

* **from_id**: The ID of the original repository on the Hugging Face Hub. Usually in the form of username/repository_name.
* **to_id**: The ID of the new repository on the Hugging Face Hub. Usually in the form of username/repository_name.
* **repo_type**: The repo type. Defaults to model. Can be:
  * model
  * dataset
  * space

## Example

Move a repository under `username` named `repo` and rename it to `repo1`

```php
<?php
include 'hub.php';
$api = new Hub('hf_***');
$api->move_repo('username/repo', 'username/repo1', 'model');
```