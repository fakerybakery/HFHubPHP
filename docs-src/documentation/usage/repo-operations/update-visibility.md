# Update Repo Visibility

### Method

```php
$api->update_repo_visibility
```

## Parameters

* **repo_id**: The ID of the original repository on the Hugging Face Hub. Usually in the form of username/repository_name.
* **private**: Boolean - true makes the repo private and false makes it public.
* **repo_type**: The repo type. Defaults to model. Can be:
  * model
  * dataset
  * space

## Example

Make `username/repo` private.

```php
<?php
include 'hub.php';
$api = new Hub('hf_***');
$api->update_repo_visibility('username/repo', True);
```