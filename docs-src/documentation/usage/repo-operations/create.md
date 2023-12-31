# Create Repository

## Method

```php
$api->create_repo
```

## Parameters

* **repo_id**: The ID of the repository on the Hugging Face Hub. Usually in the form of username/repository_name.
* **repo_type**: The repo type. Defaults to model. Can be:
  * model
  * dataset
  * space
* **private**: Option to make the repo private. Defaults to False.
* space_sdk: *This option only applies if the repo_type is space.* SDK of the Space. Can be:
  * gradio
  * streamlit
  * docker
  * static
* space_hardware: *This option only applies if the repo_type is space.* Hardware of the Space. Can be:
  * cpu-basic
  * cpu-upgrade
  * t4-small
  * t4-medium
  * zero-a10g (waitlist)
  * a10g-small
  * a10g-large
  * a10g-largex2
  * a10g-largex4
  * a100-large
* space_hardware: *This option only applies if the repo_type is space.* Persistent storage of the Space. Can be:
  * small (20 GB)
  * medium (150 GB)
  * large (1 TB)
* space_sleep_time: *This option only applies if the repo_type is space.* Sleep time in seconds of space.
* space_secrets: *This option only applies if the repo_type is space.* KV array for Space secrets.
* space_variables: *This option only applies if the repo_type is space.* KV array for Space variables.

## Example

Create a private model under `username` named `repo`:

```php
<?php
include 'hub.php';
$api = new Hub('hf_***');
$api->create_repo('username/repo', 'model', true);
```