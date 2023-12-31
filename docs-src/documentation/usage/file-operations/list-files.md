# List Files

## Method

```php
$api->list_files
```

## Parameters

* **repo_id**: The ID of the repository on the Hugging Face Hub. Usually in the form of username/repository_name.
* **repo_type**: The repo type. Defaults to model. Can be:
  * model
  * dataset
  * space
* **repo_path**: Path in repo to list. Defaults to an empty string, which lists the root directory.
* **revision**: The branch to use. Defaults to `main`.

## Response

```php
array [
  array [
    "type" => string "file|folder",
    "oid" => string,
    "size" => int,
    "path" => string
  ]
]
```

## Example

Pretty-print all files in the root directory of a the `username/repo` model.

```php
<?php
include 'hub.php';
$api = new Hub('hf_***');
$files = ($api->list_files('username/repo'));
foreach ($files as $file) {
    echo $file['type'] . ': ' . $file['path'] . ' (' . $file['size'] . ')' . "\n";
}
```
